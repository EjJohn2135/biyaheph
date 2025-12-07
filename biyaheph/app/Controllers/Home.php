<?php

namespace App\Controllers;

use App\Models\TourPackageModel;
use App\Models\TouristSpotModel;
use App\Models\TourGuideModel;
use App\Models\AccommodationModel;
use App\Models\TourAgencyModel;
class Home extends BaseController
{
    public function __construct()
    {
        helper('text'); // Load text helper
    }
    public function index(): string
    {
        $packageModel = new TourPackageModel();
        $data['featuredPackages'] = $packageModel->orderBy('created_at', 'DESC')->limit(3)->findAll();
          $data['packages'] = (new TourPackageModel())->findAll() ?? [];
        $data['touristSpots'] = (new TouristSpotModel())->findAll() ?? [];
        $data['tourGuides'] = (new TourGuideModel())->findAll() ?? [];
        $data['accommodations'] = (new AccommodationModel())->findAll() ?? [];
        $data['tourAgencies'] = (new TourAgencyModel())->findAll() ?? [];

        return view('home', $data);
    }
}