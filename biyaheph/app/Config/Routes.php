<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false);

// ============================================
// HOME & LANDING
// ============================================
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

// ============================================
// NOTIFICATIONS (Authenticated Users)
// ============================================
$routes->group('', ['filter' => 'auth'], static function($routes) {
    $routes->get('notifications/fetch', 'Notifications::fetch');
    $routes->post('notifications/mark-read', 'Notifications::markRead');
});

// ============================================
// IMAGE HANDLING
// ============================================
$routes->get('images/show/(:any)', 'Images::show/$1');

// ============================================
// AUTHENTICATION
// ============================================
$routes->group('auth', function($routes) {
    $routes->get('', 'Auth::login');
    $routes->get('login', 'Auth::login');
    $routes->post('loginPost', 'Auth::loginPost');
    $routes->get('register', 'Auth::register');
    $routes->post('registerPost', 'Auth::registerPost');
    $routes->get('approveAdmin/(:num)', 'Auth::approveAdmin/$1', ['filter' => 'authGuard']);
    $routes->get('rejectAdmin/(:num)', 'Auth::rejectAdmin/$1', ['filter' => 'authGuard']);
    $routes->get('logout', 'Auth::logout');
    $routes->get('verify/(:any)', 'Auth::verifyEmail/$1');
});

// ============================================
// DASHBOARD (Authenticated Users)
// ============================================
$routes->group('dashboard', ['filter' => 'authGuard'], function($routes) {
    $routes->get('', 'Dashboard::index');
    $routes->get('tourist', 'Dashboard::tourist');
    $routes->get('admin', 'Dashboard::admin');
});

// ============================================
// ADMIN PANEL - ACCOMMODATIONS
// ============================================
$routes->group('accommodations', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('', 'Accommodations::index');
    $routes->get('create', 'Accommodations::create');
    $routes->post('store', 'Accommodations::store');
    $routes->get('edit/(:num)', 'Accommodations::edit/$1');
    $routes->post('update/(:num)', 'Accommodations::update/$1');
    $routes->get('delete/(:num)', 'Accommodations::delete/$1');
});

// ============================================
// ADMIN PANEL - TOURIST SPOTS
// ============================================
$routes->group('touristspots', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('', 'TouristSpots::index');
    $routes->get('create', 'TouristSpots::create');
    $routes->post('store', 'TouristSpots::store');
    $routes->get('edit/(:num)', 'TouristSpots::edit/$1');
    $routes->post('update/(:num)', 'TouristSpots::update/$1');
    $routes->get('delete/(:num)', 'TouristSpots::delete/$1');
});

// ============================================
// ADMIN PANEL - TOUR AGENCIES
// ============================================
$routes->group('touragencies', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('', 'TourAgencies::index');
    $routes->get('create', 'TourAgencies::create');
    $routes->post('store', 'TourAgencies::store');
    $routes->get('edit/(:num)', 'TourAgencies::edit/$1');
    $routes->post('update/(:num)', 'TourAgencies::update/$1');
    $routes->get('delete/(:num)', 'TourAgencies::delete/$1');
});

// ============================================
// ADMIN PANEL - TOUR GUIDES
// ============================================
$routes->group('tourguides', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('', 'TourGuides::index');
    $routes->get('create', 'TourGuides::create');
    $routes->post('store', 'TourGuides::store');
    $routes->get('edit/(:num)', 'TourGuides::edit/$1');
    $routes->post('update/(:num)', 'TourGuides::update/$1');
    $routes->get('delete/(:num)', 'TourGuides::delete/$1');
});

// ============================================
// PACKAGES (Public & Admin)
// ============================================
$routes->group('packages', function($routes) {
    $routes->get('', 'Packages::index');
    $routes->get('(:num)', 'Packages::show/$1');
    
    // Admin only
    $routes->group('', ['filter' => 'adminGuard'], function($routes) {
        $routes->get('create', 'Packages::create');
        $routes->post('store', 'Packages::store');
        $routes->get('edit/(:num)', 'Packages::edit/$1');
        $routes->post('update/(:num)', 'Packages::update/$1');
        $routes->get('delete/(:num)', 'Packages::delete/$1');
    });
});

// ============================================
// BOOKINGS (Public & Admin)
// ============================================
$routes->group('bookings', ['filter' => 'authGuard'], function($routes) {
    // Tourist/User Routes
    $routes->get('book/(:num)', 'Bookings::book/$1');
    $routes->post('create', 'Bookings::create');
    $routes->post('store', 'Bookings::store');
    $routes->get('my-bookings', 'Bookings::myBookings');
    $routes->get('cancel/(:num)', 'Bookings::cancel/$1');
    $routes->get('view/(:num)', 'Bookings::view/$1');
    
    // Admin only
    $routes->group('', ['filter' => 'adminGuard'], function($routes) {
        $routes->get('manage', 'Bookings::manage');
        $routes->get('approve/(:num)', 'Bookings::approve/$1');
        $routes->get('reject/(:num)', 'Bookings::reject/$1');
        $routes->get('exportCSV', 'Bookings::exportCSV');
    });
});

// ============================================
// PAYMENTS (Authenticated Users)
// ============================================
$routes->group('payments', ['filter' => 'authGuard'], function($routes) {
    $routes->get('checkout', 'Payments::checkout');
    $routes->post('createSession', 'Payments::createSession');
    $routes->get('success', 'Payments::success');
    $routes->get('cancel', 'Payments::cancel');
});

// ============================================
// USER PROFILE (Authenticated Users)
// ============================================
$routes->group('profile', ['filter' => 'authGuard'], function($routes) {
    $routes->get('', 'Profile::index');
    $routes->post('update', 'Profile::update');
});

// ============================================
// ADMIN SETTINGS & MAINTENANCE
// ============================================
$routes->group('settings', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('maintenance', 'Settings::maintenanceSettings');
    $routes->post('maintenance', 'Settings::maintenanceSettings');
    $routes->post('toggle-maintenance', 'Settings::toggleMaintenance');
});

// ============================================
// ADMIN PANEL - ACTIVITY LOGS
// ============================================
$routes->group('admin', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('activity-logs', 'ActivityLogs::index');
    $routes->get('monitor-ip', 'Admin::monitorIp');
    $routes->post('block-ip', 'Admin::blockIp');
    $routes->post('unblock-ip', 'Admin::unblockIp');
    $routes->get('ip-details/(:any)', 'Admin::ipDetails/$1');
    
    // ============================================
    // BUG LOGS ROUTES
    // ============================================
    $routes->get('bugs', 'Bugs::index');
    $routes->get('bugs/create', 'Bugs::create');
    $routes->post('bugs/store', 'Bugs::store');
    $routes->get('bugs/show/(:num)', 'Bugs::show/$1');
    $routes->get('bugs/edit/(:num)', 'Bugs::edit/$1');
    $routes->post('bugs/update/(:num)', 'Bugs::update/$1');
    $routes->post('bugs/updateStatus/(:num)', 'Bugs::updateStatus/$1');
    $routes->get('bugs/delete/(:num)', 'Bugs::delete/$1');
    $routes->get('bugs/export', 'Bugs::export');
});

// ============================================
// MAINTENANCE MODE (Public Access)
// ============================================
$routes->post('admin/maintenance/toggle', 'Maintenance::toggle', ['filter' => 'auth']);
$routes->post('admin/maintenance/enable', 'Maintenance::enable', ['filter' => 'auth']);
$routes->post('admin/maintenance/disable', 'Maintenance::disable', ['filter' => 'auth']);
$routes->get('admin/maintenance/status', 'Maintenance::status');

// ============================================
// API ROUTES (Optional - uncomment if needed)
// ============================================
$routes->group('api', function($routes) {
    $routes->post('packages/search', 'Api\Packages::search');
    $routes->get('packages/(:num)', 'Api\Packages::show/$1');
});