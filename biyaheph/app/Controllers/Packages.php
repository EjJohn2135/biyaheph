<?php


namespace App\Controllers;

use App\Models\TourPackageModel;
use App\Models\AccommodationModel;
use App\Models\TouristSpotModel;
use App\Models\TourAgencyModel;
use App\Models\TourGuideModel;

class Packages extends BaseController
{
    protected $helpers = ['activity', 'mac'];

    public function index()
    {
        $model = new TourPackageModel();

        if (session()->get('role') === 'admin') {
            $data['packages'] = $model->select('tour_packages.*')
                ->orderBy('tour_packages.created_at', 'DESC')
                ->findAll();
            return view('packages/index', $data);
        } else {
            // Tourist view - ensure all fields including price and image are loaded
            $data['packages'] = $model->select('tour_packages.*')
                ->orderBy('tour_packages.created_at', 'DESC')
                ->findAll();
            return view('packages/tourist_index', $data);
        }
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            activity_log('create_package_denied', ['reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $accModel = new AccommodationModel();
        $spotModel = new TouristSpotModel();
        $agencyModel = new TourAgencyModel();
        $guideModel = new TourGuideModel();

        $data['accommodations'] = $accModel->findAll();
        $data['touristSpots'] = $spotModel->findAll();
        $data['tourAgencies'] = $agencyModel->findAll();
        $data['tourGuides'] = $guideModel->findAll();

        return view('packages/create', $data);
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            activity_log('create_package_denied', ['reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourPackageModel();
        
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description') ?? '',
            'details' => $this->request->getPost('details'),
            'type' => $this->request->getPost('type'),
            'date_from' => $this->request->getPost('date_from'),
            'date_to' => $this->request->getPost('date_to'),
            'price' => (float)$this->request->getPost('price'),
            'rate_per_tourist' => (float)$this->request->getPost('rate_per_tourist'),
            'max_tourists' => (int)$this->request->getPost('max_tourists'),
            'accommodation_id' => $this->request->getPost('accommodation_id') ?: null,
            'tour_agency_id' => $this->request->getPost('tour_agency_id') ?: null,
            'tour_guide_id' => $this->request->getPost('tour_guide_id') ?: null,
            'image' => null,
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $uploadPath = WRITEPATH . 'uploads';
            
            // Create directory if it doesn't exist
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $image->move($uploadPath, $newName);
            $data['image'] = $newName;
        }

        $id = $model->insert($data);
        if ($id) {
            // Handle tourist spots
            $touristSpots = $this->request->getPost('tourist_spots');
            if (!empty($touristSpots) && is_array($touristSpots)) {
                $db = \Config\Database::connect();
                foreach ($touristSpots as $spotId) {
                    $db->table('package_tourist_spots')->insert([
                        'package_id' => $id,
                        'tourist_spot_id' => $spotId
                    ]);
                }
            }

            activity_log('create_package', [
                'package_id' => $id,
                'package_name' => $data['title'],
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name'),
                'price' => $data['price'],
                'rate_per_tourist' => $data['rate_per_tourist'],
                'type' => $data['type']
            ]);
            return redirect()->to(base_url('packages'))->with('success', 'Package created successfully');
        }

        activity_log('create_package_failed', ['title' => $data['title'], 'reason' => 'insert_error']);
        return redirect()->back()->withInput()->with('error', 'Failed to create package');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            activity_log('edit_package_denied', ['package_id' => $id, 'reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourPackageModel();
        $data['package'] = $model->find($id);

        if (!$data['package']) {
            activity_log('edit_package_not_found', ['package_id' => $id]);
            return redirect()->to(base_url('packages'))->with('error', 'Package not found');
        }

        $accModel = new AccommodationModel();
        $spotModel = new TouristSpotModel();
        $agencyModel = new TourAgencyModel();
        $guideModel = new TourGuideModel();

        $data['accommodations'] = $accModel->findAll();
        $data['touristSpots'] = $spotModel->findAll();
        $data['tourAgencies'] = $agencyModel->findAll();
        $data['tourGuides'] = $guideModel->findAll();

        $db = \Config\Database::connect();
        $selectedSpots = $db->table('package_tourist_spots')
            ->select('tourist_spot_id')
            ->where('package_id', $id)
            ->get()
            ->getResultArray();
        $data['selectedSpotIds'] = array_column($selectedSpots, 'tourist_spot_id');

        return view('packages/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            activity_log('edit_package_denied', ['package_id' => $id, 'reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourPackageModel();
        $package = $model->find($id);

        if (!$package) {
            activity_log('edit_package_not_found', ['package_id' => $id]);
            return redirect()->back()->with('error', 'Package not found');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description') ?? '',
            'details' => $this->request->getPost('details'),
            'type' => $this->request->getPost('type'),
            'date_from' => $this->request->getPost('date_from'),
            'date_to' => $this->request->getPost('date_to'),
            'price' => (float)$this->request->getPost('price'),
            'rate_per_tourist' => (float)$this->request->getPost('rate_per_tourist'),
            'max_tourists' => (int)$this->request->getPost('max_tourists'),
            'accommodation_id' => $this->request->getPost('accommodation_id') ?: null,
            'tour_agency_id' => $this->request->getPost('tour_agency_id') ?: null,
            'tour_guide_id' => $this->request->getPost('tour_guide_id') ?: null,
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if (!empty($package['image'])) {
                $oldImagePath = WRITEPATH . 'uploads/' . $package['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $newName = $image->getRandomName();
            $uploadPath = WRITEPATH . 'uploads';
            
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $image->move($uploadPath, $newName);
            $data['image'] = $newName;
        }

        if ($model->update($id, $data)) {
            // Update tourist spots
            $db = \Config\Database::connect();
            $db->table('package_tourist_spots')->where('package_id', $id)->delete();
            
            $touristSpots = $this->request->getPost('tourist_spots');
            if (!empty($touristSpots) && is_array($touristSpots)) {
                foreach ($touristSpots as $spotId) {
                    $db->table('package_tourist_spots')->insert([
                        'package_id' => $id,
                        'tourist_spot_id' => $spotId
                    ]);
                }
            }

            activity_log('edit_package', [
                'package_id' => $id,
                'package_name' => $data['title'],
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name'),
                'price' => $data['price'],
                'rate_per_tourist' => $data['rate_per_tourist'],
                'type' => $data['type']
            ]);
            return redirect()->to(base_url('packages'))->with('success', 'Package updated successfully');
        }

        activity_log('edit_package_failed', ['package_id' => $id, 'package_name' => $data['title'], 'reason' => 'update_error']);
        return redirect()->back()->withInput()->with('error', 'Failed to update package');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            activity_log('delete_package_denied', ['package_id' => $id, 'reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new TourPackageModel();
        $package = $model->find($id);

        if (!$package) {
            activity_log('delete_package_not_found', ['package_id' => $id]);
            return redirect()->back()->with('error', 'Package not found');
        }

        // Delete image if exists
        if (!empty($package['image'])) {
            $imagePath = WRITEPATH . 'uploads/' . $package['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete package-tourist spot relationships
        $db = \Config\Database::connect();
        $db->table('package_tourist_spots')->where('package_id', $id)->delete();

        // Delete package
        $model->delete($id);

        activity_log('delete_package', [
            'package_id' => $id,
            'package_name' => $package['title'],
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name')
        ]);

        return redirect()->to(base_url('packages'))->with('success', 'Package deleted successfully');
    }

    public function show($id)
    {
        $packageModel = new TourPackageModel();
        $package = $packageModel->find($id);

        if (!$package) {
            return redirect()->to(base_url('packages'))->with('error', 'Package not found');
        }

        $data['package'] = $package;

        // Get accommodation details
        if (!empty($package['accommodation_id'])) {
            $accommodationModel = new AccommodationModel();
            $data['accommodation'] = $accommodationModel->find($package['accommodation_id']);
        } else {
            $data['accommodation'] = null;
        }

        // Get tour agency details
        if (!empty($package['tour_agency_id'])) {
            $tourAgencyModel = new TourAgencyModel();
            $data['tourAgency'] = $tourAgencyModel->find($package['tour_agency_id']);
        } else {
            $data['tourAgency'] = null;
        }

        // Get tour guide details
        if (!empty($package['tour_guide_id'])) {
            $tourGuideModel = new TourGuideModel();
            $data['tourGuide'] = $tourGuideModel->find($package['tour_guide_id']);
        } else {
            $data['tourGuide'] = null;
        }

        // Get tourist spots for this package
        $db = \Config\Database::connect();
        $data['touristSpots'] = $db->table('package_tourist_spots')
            ->select('tourist_spots.*')
            ->join('tourist_spots', 'tourist_spots.id = package_tourist_spots.tourist_spot_id')
            ->where('package_tourist_spots.package_id', $id)
            ->get()
            ->getResultArray();

        return view('packages/show', $data);
    }

    public function getImageUrl($imageName = null)
    {
        if (!$imageName) {
            return 'https://via.placeholder.com/400x300?text=No+Image';
        }

        $writablePath = WRITEPATH . 'uploads/' . $imageName;
        if (file_exists($writablePath)) {
            return base_url('writable/uploads/' . $imageName);
        }

        $publicPath = FCPATH . 'uploads/' . $imageName;
        if (file_exists($publicPath)) {
            return base_url('uploads/' . $imageName);
        }
        
        return 'https://via.placeholder.com/400x300?text=No+Image';
    }
}