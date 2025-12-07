<?php

namespace App\Controllers;

use App\Models\AccommodationModel;

class Accommodations extends BaseController
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

        $model = new AccommodationModel();
        $data['accommodations'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('accommodations/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        return view('accommodations/create');
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new AccommodationModel();
        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'location' => $this->request->getPost('location'),
            'price_per_night' => (float)$this->request->getPost('price_per_night'),
            'photo' => null,
        ];

        // Handle photo upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate file
            $validated = $this->validate([
                'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $newName = $file->getRandomName();
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    $data['photo'] = $newName;
                    log_message('info', 'Photo uploaded: ' . $newName);
                }
            } else {
                log_message('error', 'File validation failed: ' . json_encode($this->validator->getErrors()));
            }
        }

        if ($model->insert($data)) {
            return redirect()->to(base_url('accommodations'))->with('success', 'Accommodation added successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to add accommodation');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new AccommodationModel();
        $data['accommodation'] = $model->find($id);

        if (!$data['accommodation']) {
            return redirect()->to(base_url('accommodations'))->with('error', 'Accommodation not found');
        }

        return view('accommodations/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $model = new AccommodationModel();

        if (!$model->find($id)) {
            return redirect()->back()->with('error', 'Accommodation not found');
        }

        $file = $this->request->getFile('photo');

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'location' => $this->request->getPost('location'),
            'price_per_night' => (float)$this->request->getPost('price_per_night'),
        ];

        // Handle photo upload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $accommodation = $model->find($id);
                if (!empty($accommodation['photo'])) {
                    $oldPhotoPath = WRITEPATH . 'uploads/' . $accommodation['photo'];
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                        log_message('info', 'Old photo deleted: ' . $accommodation['photo']);
                    }
                }

                $newName = $file->getRandomName();
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    $data['photo'] = $newName;
                    log_message('info', 'New photo uploaded: ' . $newName);
                }
            }
        }

        $model->update($id, $data);

        return redirect()->to(base_url('accommodations'))->with('success', 'Accommodation updated successfully');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new AccommodationModel();
        $accommodation = $model->find($id);

        if (!$accommodation) {
            return redirect()->back()->with('error', 'Accommodation not found');
        }

        // Delete photo file
        if (!empty($accommodation['photo'])) {
            $photoPath = WRITEPATH . 'uploads/' . $accommodation['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
                log_message('info', 'Photo deleted: ' . $accommodation['photo']);
            }
        }

        $model->delete($id);

        return redirect()->to(base_url('accommodations'))->with('success', 'Accommodation deleted');
    }
}