<?php


namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\TourPackageModel;
use App\Models\UserModel;
use App\Models\NotificationModel;

class Bookings extends BaseController
{
    protected $helpers = ['activity', 'mac'];

    // ...existing code...

    public function book($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login to book');
        }

        $packageModel = new TourPackageModel();
        $package = $packageModel->find($id);
        if (!$package) {
            activity_log('book_package_not_found', [
                'package_id' => $id,
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name')
            ]);
            return redirect()->to(site_url('packages'))->with('error', 'Package not found');
        }

        return view('bookings/book', ['package' => $package]);
    }

    public function store()
    {
        // accept POST robustly
        if ($this->request->getMethod(true) !== 'POST') {
            return redirect()->back()->with('error', 'Invalid request method');
        }

        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }

        // validation
        $rules = [
            'package_id' => 'required|numeric',
            'number_of_tourists' => 'required|numeric|greater_than[0]|less_than_equal_to[50]',
            'contact_name' => 'required|min_length[2]|max_length[100]',
            'contact_email' => 'required|valid_email',
            'contact_phone' => 'required|min_length[7]|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('error', 'Validation failed: ' . implode(', ', $errors));
        }

        try {
            $bookingModel = new BookingModel();
            $packageModel = new TourPackageModel();

            $packageId = (int)$this->request->getPost('package_id');
            $package = $packageModel->find($packageId);
            if (!$package) {
                activity_log('create_booking_package_not_found', [
                    'package_id' => $packageId,
                    'user_id' => session()->get('id'),
                    'user_name' => session()->get('name')
                ]);
                return redirect()->back()->with('error', 'Package not found');
            }

            $numberOfTourists = max(1, (int)$this->request->getPost('number_of_tourists'));
            $rate = (float) ($package['rate_per_tourist'] ?? $package['price'] ?? 0);
            $totalPrice = $numberOfTourists * $rate;

            $data = [
                'user_id' => session()->get('id'),
                'package_id' => $packageId,
                'number_of_tourists' => $numberOfTourists,
                'total_price' => $totalPrice,
                'contact_name' => trim($this->request->getPost('contact_name')),
                'contact_email' => trim($this->request->getPost('contact_email')),
                'contact_phone' => trim($this->request->getPost('contact_phone')),
                'special_requests' => trim($this->request->getPost('special_requests') ?? ''),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $bookingId = $bookingModel->insert($data);
            if ($bookingId) {
                $ref = 'BK-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);
                activity_log('create_booking', [
                    'booking_id' => $bookingId,
                    'booking_ref' => $ref,
                    'package_name' => $package['title'] ?? '-',
                    'package_id' => $packageId,
                    'user_id' => session()->get('id'),
                    'user_name' => session()->get('name'),
                    'number_of_tourists' => $numberOfTourists,
                    'total_price' => $totalPrice
                ]);

                // Notify all admins about new booking (include clickable url)
                $userModel = new UserModel();
                $notifModel = new NotificationModel();
                $admins = $userModel->where('role', 'admin')->findAll();
                $bookingUserName = session()->get('name') ?? 'Guest';
                $packageTitle = $package['title'] ?? '-';
                $message = "{$bookingUserName} booked \"{$packageTitle}\" (Ref: {$ref}). Click to review.";
                $url = site_url('bookings/view/' . $bookingId);

                foreach ($admins as $admin) {
                    $notifModel->insert([
                        'user_id' => $admin['id'],
                        'title' => "New Booking: {$ref}",
                        'message' => $message,
                        'url' => $url,
                        'is_read' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }

                return redirect()->to(site_url('dashboard/tourist'))->with('success', 'Booking submitted! Reference: ' . $ref);
            }

            activity_log('create_booking_failed', [
                'package_id' => $packageId,
                'user_id' => session()->get('id'),
                'reason' => 'insert_error'
            ]);
            return redirect()->back()->withInput()->with('error', 'Failed to submit booking');
        } catch (\Throwable $e) {
            log_message('error', 'Booking store error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'An error occurred while processing your booking');
        }
    }

    public function create()
    {
        // accept POST robustly
        if ($this->request->getMethod(true) !== 'POST') {
            return redirect()->back()->with('error', 'Invalid request method.');
        }

        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login to book.');
        }

        $packageId = (int)$this->request->getPost('package_id');
        if (empty($packageId)) {
            activity_log('create_booking_no_package', [
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name')
            ]);
            return redirect()->back()->with('error', 'No package selected.');
        }

        $packageModel = new TourPackageModel();
        $package = $packageModel->find($packageId);
        if (!$package) {
            activity_log('create_booking_package_not_found', [
                'package_id' => $packageId,
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name')
            ]);
            return redirect()->back()->with('error', 'Package not found.');
        }

        try {
            $bookingModel = new BookingModel();
            $rate = (float) ($package['rate_per_tourist'] ?? $package['price'] ?? 0);
            $data = [
                'user_id' => session()->get('id'),
                'package_id' => $packageId,
                'number_of_tourists' => 1,
                'total_price' => $rate,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $bookingId = $bookingModel->insert($data);
            if ($bookingId) {
                $ref = 'BK-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);
                activity_log('create_booking', [
                    'booking_id' => $bookingId,
                    'booking_ref' => $ref,
                    'package_name' => $package['title'] ?? '-',
                    'package_id' => $packageId,
                    'user_id' => session()->get('id'),
                    'user_name' => session()->get('name'),
                    'number_of_tourists' => 1,
                    'total_price' => $rate
                ]);

                // Notify admins (clickable)
                $userModel = new UserModel();
                $notifModel = new NotificationModel();
                $admins = $userModel->where('role', 'admin')->findAll();
                $bookingUserName = session()->get('name') ?? 'Guest';
                $packageTitle = $package['title'] ?? '-';
                $message = "{$bookingUserName} booked \"{$packageTitle}\" (Ref: {$ref}). Click to review.";
                $url = site_url('bookings/view/' . $bookingId);

                foreach ($admins as $admin) {
                    $notifModel->insert([
                        'user_id' => $admin['id'],
                        'title' => "New Booking: {$ref}",
                        'message' => $message,
                        'url' => $url,
                        'is_read' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }

                return redirect()->to(site_url('dashboard/tourist'))->with('success', 'Booking created successfully. Reference: ' . $ref);
            }

            activity_log('create_booking_failed', [
                'package_id' => $packageId,
                'user_id' => session()->get('id'),
                'reason' => 'insert_error'
            ]);
            return redirect()->back()->with('error', 'Failed to create booking.');
        } catch (\Throwable $e) {
            log_message('error', 'Booking create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating booking.');
        }
    }

    public function myBookings()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }
        if (session()->get('role') !== 'tourist') {
            return redirect()->to(site_url('dashboard'))->with('error', 'Access denied');
        }

        $bookingModel = new BookingModel();
        $userId = session()->get('id');

        $bookings = $bookingModel
            ->select('bookings.*, tour_packages.title, tour_packages.image')
            ->join('tour_packages', 'tour_packages.id = bookings.package_id')
            ->where('bookings.user_id', $userId)
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();

        return view('bookings/my-bookings', ['bookings' => $bookings]);
    }

    public function manage()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }
        if (session()->get('role') !== 'admin') {
            return redirect()->to(site_url('dashboard'))->with('error', 'Access denied');
        }

        $bookingModel = new BookingModel();
        $status = $this->request->getGet('status');

        $query = $bookingModel
            ->select('bookings.*, tour_packages.title as package_title, users.name as user_name, users.email as user_email')
            ->join('tour_packages', 'tour_packages.id = bookings.package_id')
            ->join('users', 'users.id = bookings.user_id');

        if (!empty($status)) {
            $query->where('bookings.status', $status);
        }

        $bookings = $query->orderBy('bookings.created_at', 'DESC')->findAll();

        return view('bookings/manage', [
            'bookings' => $bookings,
            'currentStatus' => $status
        ]);
    }

    public function approve($bookingId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }
        if (session()->get('role') !== 'admin') {
            activity_log('approve_booking_denied', ['booking_id' => $bookingId, 'reason' => 'unauthorized']);
            return redirect()->to(site_url('dashboard'))->with('error', 'Access denied');
        }

        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($bookingId);

        if (!$booking) {
            activity_log('approve_booking_not_found', [
                'booking_id' => $bookingId,
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name')
            ]);
            return redirect()->back()->with('error', 'Booking not found');
        }

        $bookingModel->update($bookingId, [
            'status' => 'approved',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        activity_log('approve_booking', [
            'booking_id' => $bookingId,
            'booking_ref' => 'BK-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT),
            'approved_by' => session()->get('id'),
            'approved_by_name' => session()->get('name'),
            'total_price' => $booking['total_price']
        ]);

        // Notify the booking user (clickable)
        try {
            $notifModel = new NotificationModel();
            $ref = 'BK-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);
            $message = "Your booking (Ref: {$ref}) has been approved by admin. View details in My Bookings.";
            $notifModel->insert([
                'user_id' => $booking['user_id'],
                'title' => "Booking Approved: {$ref}",
                'message' => $message,
                'url' => site_url('bookings/view/' . $bookingId),
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Notify user on approve failed: ' . $e->getMessage());
        }

        return redirect()->to(site_url('bookings/manage'))->with('success', 'Booking approved');
    }

    public function reject($bookingId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }
        if (session()->get('role') !== 'admin') {
            activity_log('reject_booking_denied', ['booking_id' => $bookingId, 'reason' => 'unauthorized']);
            return redirect()->to(site_url('dashboard'))->with('error', 'Access denied');
        }

        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($bookingId);

        if (!$booking) {
            activity_log('reject_booking_not_found', [
                'booking_id' => $bookingId,
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name')
            ]);
            return redirect()->back()->with('error', 'Booking not found');
        }

        $bookingModel->update($bookingId, [
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        activity_log('reject_booking', [
            'booking_id' => $bookingId,
            'booking_ref' => 'BK-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT),
            'rejected_by' => session()->get('id'),
            'rejected_by_name' => session()->get('name')
        ]);

        // Notify the booking user (clickable)
        try {
            $notifModel = new NotificationModel();
            $ref = 'BK-' . str_pad($bookingId, 6, '0', STR_PAD_LEFT);
            $message = "Your booking (Ref: {$ref}) has been rejected by admin. Contact support for details.";
            $notifModel->insert([
                'user_id' => $booking['user_id'],
                'title' => "Booking Rejected: {$ref}",
                'message' => $message,
                'url' => site_url('bookings/view/' . $bookingId),
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Notify user on reject failed: ' . $e->getMessage());
        }

        return redirect()->to(site_url('bookings/manage'))->with('success', 'Booking rejected');
    }

    // New: view redirector — navigates to appropriate page and preserves highlight query param
    public function view($bookingId = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }

        if (empty($bookingId)) {
            return redirect()->back()->with('error', 'Invalid booking id');
        }

        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found');
        }

        $role = session()->get('role');
        $userId = session()->get('id');

        if ($role === 'admin') {
            return redirect()->to(site_url('bookings/manage') . '?highlight=' . $bookingId);
        }

        if ($booking['user_id'] == $userId) {
            return redirect()->to(site_url('bookings/my-bookings') . '?highlight=' . $bookingId);
        }

        return redirect()->to(site_url('dashboard'))->with('error', 'Access denied');
    }

    // ...existing code (cancel, exportCSV, etc.)...
}