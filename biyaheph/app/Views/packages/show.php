
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
  <a href="<?= base_url('packages') ?>" class="btn btn-outline-secondary btn-sm mb-3">
    <i class="fa fa-arrow-left me-1"></i> Back to Packages
  </a>
</div>

<div class="row">
  <div class="col-lg-8">
    <!-- Package Image -->
    <div class="card border-0 shadow-sm mb-4">
      <?php if (!empty($package['image'])): ?>
        <img src="<?= base_url('writable/uploads/'.$package['image']) ?>" class="card-img-top" style="height:400px;object-fit:cover;">
      <?php else: ?>
        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:400px;">
          <i class="fa fa-image fa-5x text-muted"></i>
        </div>
      <?php endif; ?>
    </div>

    <!-- Package Info -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <h2 class="mb-2"><?= esc($package['title']) ?></h2>
            <span class="badge bg-<?= $package['type'] === 'joiner' ? 'info' : 'warning' ?> me-2">
              <?= ucfirst($package['type']) ?>
            </span>
            <span class="badge bg-secondary">
              <i class="fa fa-users me-1"></i> Max <?= $package['max_tourists'] ?> tourists
            </span>
          </div>
          <div class="text-end">
            <p class="text-muted mb-1">Per Person</p>
            <h3 class="text-primary mb-0">₱<?= number_format($package['rate_per_tourist'], 2) ?></h3>
          </div>
        </div>

        <hr>

        <h5 class="mb-3">Package Details</h5>
        <p class="text-muted"><?= nl2br(esc($package['details'])) ?></p>

        <div class="row mt-4">
          <div class="col-md-6 mb-3">
            <strong>Date From:</strong>
            <p><?= date('M d, Y', strtotime($package['date_from'] ?? 'now')) ?></p>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Date To:</strong>
            <p><?= date('M d, Y', strtotime($package['date_to'] ?? 'now')) ?></p>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Total Package Price:</strong>
            <p>₱<?= number_format($package['price'], 2) ?></p>
          </div>
          <div class="col-md-6 mb-3">
            <strong>Duration:</strong>
            <p><?php 
              $from = new DateTime($package['date_from'] ?? 'now');
              $to = new DateTime($package['date_to'] ?? 'now');
              $interval = $from->diff($to);
              echo $interval->days . ' days';
            ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Inclusions -->
    <?php if (!empty($package['accommodation_id']) || !empty($package['tour_agency_id']) || !empty($package['tour_guide_id'])): ?>
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">
            <i class="fa fa-check-circle me-2 text-success"></i> Package Inclusions
          </h5>
        </div>
        <div class="card-body">
          <div class="row">
            <?php if (!empty($accommodation)): ?>
              <div class="col-md-6 mb-3">
                <h6 class="mb-2">
                  <i class="fa fa-hotel me-2 text-info"></i> Accommodation
                </h6>
                <p class="mb-1"><strong><?= esc($accommodation['name']) ?></strong></p>
                <p class="text-muted small mb-0">₱<?= number_format($accommodation['price_per_night'], 2) ?>/night</p>
              </div>
            <?php endif; ?>

            <?php if (!empty($tourGuide)): ?>
              <div class="col-md-6 mb-3">
                <h6 class="mb-2">
                  <i class="fa fa-user-tie me-2 text-warning"></i> Tour Guide
                </h6>
                <p class="mb-1"><strong><?= esc($tourGuide['name']) ?></strong></p>
                <p class="text-muted small mb-0"><?= esc($tourGuide['expertise']) ?></p>
              </div>
            <?php endif; ?>

            <?php if (!empty($tourAgency)): ?>
              <div class="col-md-6 mb-3">
                <h6 class="mb-2">
                  <i class="fa fa-briefcase me-2 text-success"></i> Tour Agency
                </h6>
                <p class="mb-0"><strong><?= esc($tourAgency['name']) ?></strong></p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- Tourist Spots -->
    <?php if (!empty($touristSpots)): ?>
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">
            <i class="fa fa-map-pin me-2 text-danger"></i> Tourist Spots Included
          </h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <?php foreach($touristSpots as $spot): ?>
              <div class="col-md-6">
                <div class="d-flex">
                  <div class="me-3">
                    <i class="fa fa-map-pin fa-2x text-danger"></i>
                  </div>
                  <div>
                    <h6 class="mb-1"><?= esc($spot['name']) ?></h6>
                    <p class="text-muted small mb-0"><?= esc($spot['location']) ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Booking Sidebar -->
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm sticky-top" style="top:20px;">
      <div class="card-body">
        <h5 class="card-title mb-3">Book This Package</h5>

        <?php if (session()->get('logged_in')): ?>
          <div class="mb-4">
            <p class="text-muted small mb-2">Package Price</p>
            <h4 class="mb-0 text-primary">₱<?= number_format($package['price'], 2) ?></h4>
            <p class="text-muted small">Total for all tourists</p>
          </div>

          <a href="<?= base_url('bookings/book/'.$package['id']) ?>" class="btn btn-primary btn-lg w-100 mb-2">
            <i class="fa fa-calendar-check me-2"></i> Book Now
          </a>
          <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary w-100">
            Back to Dashboard
          </a>
        <?php else: ?>
          <div class="alert alert-warning">
            <i class="fa fa-info-circle me-2"></i> You must be logged in to book.
          </div>
          <a href="<?= base_url('auth/login') ?>" class="btn btn-primary btn-lg w-100 mb-2">
            <i class="fa fa-sign-in-alt me-2"></i> Login to Book
          </a>
          <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-primary w-100">
            Create Account
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>