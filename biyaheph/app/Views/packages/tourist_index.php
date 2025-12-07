
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
  <h2 class="mb-1">Available Tour Packages</h2>
  <p class="text-muted mb-0">Explore and book amazing tour packages</p>
</div>

<div class="row g-3">
  <?php foreach($packages as $p):
    // Safe defaults to avoid undefined array key errors
    $type = $p['type'] ?? 'joiner';
    $title = $p['title'] ?? 'Untitled Package';
    $image = $p['image'] ?? '';
    $details = $p['details'] ?? '';
    $dateFrom = $p['date_from'] ?? date('Y-m-d');
    $dateTo = $p['date_to'] ?? date('Y-m-d');
    $maxTourists = $p['max_tourists'] ?? 50;
    // Use rate_per_tourist first, then price, fallback null
    $rate = isset($p['rate_per_tourist']) ? (float)$p['rate_per_tourist'] : (isset($p['price']) ? (float)$p['price'] : null);
    $id = $p['id'] ?? null;
  ?>
    <div class="col-md-4">
      <div class="card h-100 shadow-sm hover-shadow" style="transition: transform 0.2s;">
        <?php if (!empty($image) && file_exists(FCPATH . 'writable/uploads/' . $image)): ?>
          <img src="<?= base_url('writable/uploads/' . $image) ?>" class="card-img-top" style="height:200px;object-fit:cover;" alt="<?= esc($title) ?>">
        <?php else: ?>
          <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">
            <i class="fa fa-image fa-3x text-muted"></i>
          </div>
        <?php endif; ?>

        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0"><?= esc($title) ?></h5>
            <span class="badge bg-<?= $type === 'joiner' ? 'info' : 'warning' ?>">
              <?= ucfirst(esc($type)) ?>
            </span>
          </div>

          <p class="card-text text-muted small mb-2">
            <?= esc(strlen($details) > 60 ? substr($details, 0, 60) . '...' : $details) ?>
          </p>

          <div class="small text-muted mb-3">
            <div class="mb-1">
              <i class="fa fa-calendar me-1"></i>
              <?= date('M d', strtotime($dateFrom)) ?> - <?= date('M d, Y', strtotime($dateTo)) ?>
            </div>
            <div>
              <i class="fa fa-users me-1"></i>
              Max <?= esc($maxTourists) ?> tourists
            </div>
          </div>

          <div class="mt-auto">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div>
                <span class="text-muted small">Per Person:</span><br>
                <?php if ($rate !== null): ?>
                  <strong class="h5 mb-0">₱<?= number_format($rate, 2) ?></strong>
                <?php else: ?>
                  <strong class="h6 mb-0 text-muted">Contact for price</strong>
                <?php endif; ?>
              </div>
            </div>

            <?php if(session()->get('role') == 'tourist'): ?>
              <a href="<?= site_url('bookings/book/' . $id) ?>" class="btn btn-primary btn-sm w-100">
                <i class="fa fa-shopping-cart me-1"></i> Book Now
              </a>
            <?php elseif(session()->get('role') == 'admin'): ?>
              <a href="<?= site_url('packages/edit/' . $id) ?>" class="btn btn-warning btn-sm w-100">
                <i class="fa fa-edit me-1"></i> Edit
              </a>
            <?php else: ?>
              <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-primary btn-sm w-100">
                <i class="fa fa-sign-in-alt me-1"></i> Login to Book
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?= $this->endSection() ?>