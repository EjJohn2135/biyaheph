<?php

namespace App\Controllers;

use App\Models\TourAgencyModel;

class TourAgencies extends BaseController
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

        $model = new TourAgencyModel();
        $data['agencies'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('touragencies/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        return view('touragencies/create');
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new TourAgencyModel();
        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
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
            return redirect()->to(base_url('touragencies'))->with('success', 'Tour agency added successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add tour agency');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourAgencyModel();
        $data['agency'] = $model->find($id);

        if (!$data['agency']) {
            return redirect()->to(base_url('touragencies'))->with('error', 'Tour agency not found');
        }

        return view('touragencies/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new TourAgencyModel();

        if (!$model->find($id)) {
            return redirect()->back()->with('error', 'Tour agency not found');
        }

        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ];

        // Handle photo upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $agency = $model->find($id);
                if (!empty($agency['photo'])) {
                    $oldPhotoPath = WRITEPATH . 'uploads/' . $agency['photo'];
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

        return redirect()->to(base_url('touragencies'))->with('success', 'Tour agency updated successfully');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourAgencyModel();
        $agency = $model->find($id);

        if (!$agency) {
            return redirect()->back()->with('error', 'Tour agency not found');
        }

        // Delete photo file
        if (!empty($agency['photo'])) {
            $photoPath = WRITEPATH . 'uploads/' . $agency['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $model->delete($id);

        return redirect()->to(base_url('touragencies'))->with('success', 'Tour agency deleted');
    }
}