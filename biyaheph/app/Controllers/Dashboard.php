<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TourPackageModel;
use App\Models\BookingModel;
use App\Models\TouristSpotModel;
use App\Models\AccommodationModel;
use App\Models\TourGuideModel;
use App\Models\TourAgencyModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $role = session()->get('role');

        if ($role === 'admin') {
            return $this->adminDashboard();
        }

        if ($role === 'tourist') {
            return $this->touristDashboard();
        }

        return redirect()->to(base_url('auth/login'));
    }

    private function adminDashboard()
    {
        $packageModel = new TourPackageModel();
        $bookingModel = new BookingModel();
        $userModel = new UserModel();

        $data = [];
        $data['totalPackages']   = $packageModel->countAllResults();
        $data['totalBookings']   = $bookingModel->countAllResults();
        $data['pendingBookings'] = $bookingModel->where('status', 'pending')->countAllResults();

        $data['totalRevenue'] = 0;
        $approved = $bookingModel->where('status', 'approved')->findAll();
        foreach ($approved as $b) {
            $data['totalRevenue'] += $b['total_price'] ?? 0;
        }

        $data['pendingAdmins'] = $userModel
            ->where('role', 'admin')
            ->where('approved', 0)
            ->findAll();

        return view('dashboard/admin', $data);
    }

    private function touristDashboard()
    {
        $bookingModel = new BookingModel();
        $packageModel = new TourPackageModel();
        $touristSpotModel = new TouristSpotModel();
        $accommodationModel = new AccommodationModel();
        $tourGuideModel = new TourGuideModel();
        $tourAgencyModel = new TourAgencyModel();
        $userId = session()->get('id');

        $data = [];

        // All Packages with image and proper pricing
        $data['packages'] = $packageModel->select('tour_packages.*')
            ->orderBy('tour_packages.created_at', 'DESC')
            ->findAll() ?: [];

        // Tourist Spots
        $data['touristSpots'] = $touristSpotModel->findAll() ?: [];

        // Accommodations
        $data['accommodations'] = $accommodationModel->findAll() ?: [];

        // Tour Guides
        $data['tourGuides'] = $tourGuideModel->findAll() ?: [];

        // Tour Agencies
        $data['tourAgencies'] = $tourAgencyModel->findAll() ?: [];

        // User bookings
        $data['myBookings'] = $bookingModel
            ->select('bookings.*, tour_packages.title, tour_packages.image')
            ->join('tour_packages', 'tour_packages.id = bookings.package_id')
            ->where('bookings.user_id', $userId)
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll() ?: [];

        // Booking status counts
        $data['currentStatus'] = [
            'pending'   => $bookingModel->where('user_id', $userId)->where('status', 'pending')->countAllResults(),
            'approved'  => $bookingModel->where('user_id', $userId)->where('status', 'approved')->countAllResults(),
            'rejected'  => $bookingModel->where('user_id', $userId)->where('status', 'rejected')->countAllResults(),
            'cancelled' => $bookingModel->where('user_id', $userId)->where('status', 'cancelled')->countAllResults(),
        ];

        // Total spent
        $data['totalSpent'] = 0;
        foreach ($data['myBookings'] as $b) {
            if (($b['status'] ?? '') === 'approved') {
                $data['totalSpent'] += $b['total_price'] ?? 0;
            }
        }

        return view('dashboard/tourist', $data);
    }
}