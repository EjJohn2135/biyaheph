<?php

namespace App\Controllers;

use App\Models\TourGuideModel;

class TourGuides extends BaseController
{
    public function __construct()
    {
        helper('text');
    }

    private function ensureUploadsFolder()
    {
        $uploadsPath = WRITEPATH . 'uploads';
        if (!is_dir($uploadsPath)) {
            mkdir($uploadsPath, 0755, true);
        }
    }

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourGuideModel();
        $data['guides'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('tourguides/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        return view('tourguides/create');
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new TourGuideModel();
        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'contact' => $this->request->getPost('contact'),
            'expertise' => $this->request->getPost('expertise'),
            'photo' => null,
        ];

        // Handle photo upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $newName = $file->getRandomName();
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    $data['photo'] = $newName;
                    log_message('info', 'Photo uploaded: ' . $newName);
                }
            }
        }

        if ($model->insert($data)) {
            return redirect()->to(base_url('tourguides'))->with('success', 'Tour guide added successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add tour guide');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourGuideModel();
        $data['guide'] = $model->find($id);

        if (!$data['guide']) {
            return redirect()->to(base_url('tourguides'))->with('error', 'Tour guide not found');
        }

        return view('tourguides/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new TourGuideModel();

        if (!$model->find($id)) {
            return redirect()->back()->with('error', 'Tour guide not found');
        }

        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'contact' => $this->request->getPost('contact'),
            'expertise' => $this->request->getPost('expertise'),
        ];

        // Handle photo upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $guide = $model->find($id);
                if (!empty($guide['photo'])) {
                    $oldPhotoPath = WRITEPATH . 'uploads/' . $guide['photo'];
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                $newName = $file->getRandomName();
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    $data['photo'] = $newName;
                }
            }
        }

        $model->update($id, $data);

        return redirect()->to(base_url('tourguides'))->with('success', 'Tour guide updated successfully');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourGuideModel();
        $guide = $model->find($id);

        if (!$guide) {
            return redirect()->back()->with('error', 'Tour guide not found');
        }

        // Delete photo file
        if (!empty($guide['photo'])) {
            $photoPath = WRITEPATH . 'uploads/' . $guide['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $model->delete($id);

        return redirect()->to(base_url('tourguides'))->with('success', 'Tour guide deleted');
    }
}