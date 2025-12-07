
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="bg-primary text-white py-5 rounded-3 mb-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="display-4 fw-bold mb-3">Explore the Philippines</h1>
      <p class="lead mb-4">Discover amazing tour packages and book your next adventure today!</p>
      
      <?php if (session()->get('logged_in')): ?>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-light btn-lg me-2">
          <i class="fa fa-map-marker-alt me-2"></i> Browse Packages
        </a>
      <?php else: ?>
        <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-lg me-2">
          <i class="fa fa-user-plus me-2"></i> Join Now
        </a>
        <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-lg">
          <i class="fa fa-sign-in-alt me-2"></i> Login
        </a>
      <?php endif; ?>
    </div>
    <div class="col-md-6 text-center">
      <i class="fa fa-plane fa-5x opacity-50"></i>
    </div>
  </div>
</div>

<!-- Featured Packages Section -->
<div class="mb-5">
  <h2 class="mb-4">Featured Tour Packages</h2>

  <?php if (empty($featuredPackages)): ?>
    <div class="alert alert-info">
      <i class="fa fa-info-circle me-2"></i> No packages available yet. Check back soon!
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach ($featuredPackages as $p): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <?php if (! empty($p['image'])): ?>
              <img src="<?= base_url('writable/uploads/' . $p['image']) ?>" class="card-img-top" style="height:250px;object-fit:cover;">
            <?php else: ?>
              <div class="bg-light d-flex align-items-center justify-content-center" style="height:250px;">
                <i class="fa fa-image fa-3x text-muted"></i>
              </div>
            <?php endif; ?>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= esc($p['title']) ?></h5>
              <p class="card-text text-muted mb-3"><?= esc(word_limiter($p['description'], 30)) ?></p>

              <div class="mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="fw-bold fs-5">₱<?= esc(number_format($p['price'],2)) ?></span>
                  <span class="badge bg-info">Popular</span>
                </div>

                <?php if (session()->get('logged_in')): ?>
                  <a href="<?= base_url('bookings/create/'.$p['id']) ?>" class="btn btn-primary w-100">
                    <i class="fa fa-shopping-cart me-1"></i> Book Now
                  </a>
                <?php else: ?>
                  <a href="<?= base_url('auth/register') ?>" class="btn btn-primary w-100">
                    <i class="fa fa-sign-up-alt me-1"></i> Register to Book
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if (session()->get('logged_in')): ?>
      <div class="text-center mt-5">
        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary btn-lg">
          <i class="fa fa-arrow-right me-1"></i> View All Packages
        </a>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<!-- Info Section -->
<div class="row g-4 mb-5">
  <div class="col-md-4">
    <div class="text-center">
      <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px;height:80px;">
        <i class="fa fa-check-circle fa-2x"></i>
      </div>
      <h5>Easy Booking</h5>
      <p class="text-muted">Simple and quick booking process for all tour packages</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="text-center">
      <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px;height:80px;">
        <i class="fa fa-credit-card fa-2x"></i>
      </div>
      <h5>Secure Payment</h5>
      <p class="text-muted">Safe and secure payment options with Stripe integration</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="text-center">
      <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width:80px;height:80px;">
        <i class="fa fa-headset fa-2x"></i>
      </div>
      <h5>24/7 Support</h5>
      <p class="text-muted">Always available to help with your travel queries</p>
    </div>
  </div>
</div>

<!-- CTA Section -->
<div class="bg-light p-5 rounded-3 text-center mb-5">
  <h3 class="mb-3">Ready for Your Next Adventure?</h3>
  <p class="text-muted mb-4">Join thousands of travelers exploring the beautiful Philippines with BiyahePH</p>
  
  <?php if (! session()->get('logged_in')): ?>
    <div class="d-flex gap-2 justify-content-center flex-wrap">
      <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-lg">
        <i class="fa fa-user-plus me-1"></i> Register as Tourist
      </a>
      <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-primary btn-lg">
        <i class="fa fa-briefcase me-1"></i> Request Admin Access
      </a>
    </div>
  <?php else: ?>
    <a href="<?= base_url('dashboard') ?>" class="btn btn-primary btn-lg">
      <i class="fa fa-compass me-1"></i> Start Exploring
    </a>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>