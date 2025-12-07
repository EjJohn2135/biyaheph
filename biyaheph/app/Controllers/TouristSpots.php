<?php

namespace App\Controllers;

use App\Models\TouristSpotModel;

class TouristSpots extends BaseController
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

        $model = new TouristSpotModel();
        $data['spots'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('touristspots/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        return view('touristspots/create');
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new TouristSpotModel();
        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'location' => $this->request->getPost('location'),
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
            return redirect()->to(base_url('touristspots'))->with('success', 'Tourist spot added successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add tourist spot');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TouristSpotModel();
        $data['spot'] = $model->find($id);

        if (!$data['spot']) {
            return redirect()->to(base_url('touristspots'))->with('error', 'Tourist spot not found');
        }

        return view('touristspots/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new TouristSpotModel();

        if (!$model->find($id)) {
            return redirect()->back()->with('error', 'Tourist spot not found');
        }

        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'location' => $this->request->getPost('location'),
        ];

        // Handle photo upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $spot = $model->find($id);
                if (!empty($spot['photo'])) {
                    $oldPhotoPath = WRITEPATH . 'uploads/' . $spot['photo'];
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

        return redirect()->to(base_url('touristspots'))->with('success', 'Tourist spot updated successfully');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TouristSpotModel();
        $spot = $model->find($id);

        if (!$spot) {
            return redirect()->back()->with('error', 'Tourist spot not found');
        }

        // Delete photo file
        if (!empty($spot['photo'])) {
            $photoPath = WRITEPATH . 'uploads/' . $spot['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $model->delete($id);

        return redirect()->to(base_url('touristspots'))->with('success', 'Tourist spot deleted');
    }
}