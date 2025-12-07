
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
function getImageUrl($item = []) {
    if (!is_array($item)) return base_url('images/placeholder.png');
    $img = $item['image'] ?? $item['photo'] ?? $item['image_path'] ?? null;
    if (empty($img)) return base_url('images/placeholder.png');
    return base_url('writable/uploads/' . rawurlencode($img));
}

function getPlaceholderSvg($text = 'Image') {
    return 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect fill=%22%23e2e8f0%22 width=%22400%22 height=%22300%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2224%22 fill=%22%2364748b%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-family=%22Arial%22%3E' . urlencode($text) . '%3C/text%3E%3C/svg%3E';
}
?>

<style>
  .section-title { 
    font-size: 1.8rem; 
    color: #0066cc; 
    font-weight: 700; 
    margin-bottom: 2rem; 
    padding-bottom: 1rem; 
    border-bottom: 3px solid #00a8e8; 
    display: inline-block; 
  }
  
  .stat-box { 
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%); 
    border: none; 
    border-radius: 1rem; 
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1); 
    overflow: hidden; 
    position: relative; 
  }
  
  .stat-box::before { 
    content: ''; 
    position: absolute; 
    top: 0; 
    left: 0; 
    right: 0; 
    height: 4px; 
    background: linear-gradient(90deg, #0066cc, #00a8e8); 
  }
  
  .stat-box:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 15px 40px rgba(0,102,204,0.2); 
  }
  
  .package-card { 
    border: none; 
    border-radius: 1.2rem; 
    overflow: hidden; 
    transition: all 0.3s ease; 
    height: 100%; 
    background: #fff; 
    display: flex; 
    flex-direction: column;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  }
  
  .package-card:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 12px 30px rgba(0,102,204,0.2); 
  }
  
  .package-card img { 
    width: 100%; 
    height: 220px; 
    object-fit: cover; 
    transition: transform .3s ease; 
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
  }
  
  .package-card:hover img { 
    transform: scale(1.05); 
  }
  
  .package-body { 
    padding: 1.5rem; 
    flex-grow: 1; 
    display: flex; 
    flex-direction: column; 
  }
  
  .price-section { 
    border-top: 1px solid #e2e8f0; 
    padding-top: 1rem; 
    margin-top: auto; 
  }
  
  .btn-book { 
    background: linear-gradient(135deg, #0066cc 0%, #00a8e8 100%); 
    border: none; 
    border-radius: .6rem; 
    font-weight: 600; 
    transition: all .3s ease; 
    color: #fff;
    padding: 0.75rem 1.5rem;
  }
  
  .btn-book:hover { 
    transform: translateY(-2px); 
    box-shadow: 0 8px 20px rgba(0, 102, 204, .4);
    color: #fff;
  }
  
  .empty-state { 
    text-align: center; 
    padding: 3rem 1rem; 
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); 
    border-radius: 1rem; 
    border: 2px dashed #00a8e8; 
  }
  
  .section-divider { 
    height: 1px; 
    background: linear-gradient(90deg, transparent, #00a8e8, transparent); 
    margin: 3rem 0; 
  }

  .photo-card {
    border: none;
    border-radius: 1.2rem;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
  }

  .photo-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,102,204,0.2);
  }

  .photo-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg,#0066cc 0%,#00a8e8 100%);
  }

  .photo-card-body {
    padding: 1.5rem;
    text-align: center;
  }

  .photo-card-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
  }

  .photo-card-info {
    font-size: 0.9rem;
    color: #64748b;
    margin-bottom: 0.5rem;
  }

  .price-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
    display: inline-block;
    margin-top: 0.5rem;
  }

  @media (max-width: 768px) {
    .package-card img { height: 180px; }
    .photo-card-img { height: 160px; }
  }
</style>

<!-- Hero Section -->
<div class="mb-5">
  <div style="background:linear-gradient(135deg,#0066cc 0%,#00a8e8 100%); border-radius:1.5rem; padding:3rem; color:white;">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h1 style="font-size:2.8rem; font-weight:700; margin-bottom:.5rem;">
          <i class="fas fa-compass me-3"></i>Welcome Back, <?= esc(session()->get('name')) ?>
        </h1>
        <p style="font-size:1.1rem; opacity:.95;">Explore amazing destinations and manage your bookings all in one place</p>
      </div>
      <div class="col-md-4 text-center"><i class="fas fa-plane-departure" style="font-size:5rem; opacity:.2;"></i></div>
    </div>
  </div>
</div>

<!-- Stats -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="card stat-box shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <p class="text-muted mb-2" style="font-size:.85rem; font-weight:600;">Total Bookings</p>
          <h2 class="mb-0" style="background:linear-gradient(135deg,#0066cc 0%,#00a8e8 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent;"><?= count($myBookings ?? []) ?></h2>
        </div>
        <div style="font-size:2.5rem; color:#0066cc; opacity:.15;"><i class="fas fa-ticket-alt"></i></div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card stat-box shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <p class="text-muted mb-2" style="font-size:.85rem; font-weight:600;">Approved</p>
          <h2 class="mb-0" style="color:#10b981;"><?= $currentStatus['approved'] ?? 0 ?></h2>
        </div>
        <div style="font-size:2.5rem; color:#10b981; opacity:.15;"><i class="fas fa-check-circle"></i></div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card stat-box shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <p class="text-muted mb-2" style="font-size:.85rem; font-weight:600;">Pending</p>
          <h2 class="mb-0" style="color:#f59e0b;"><?= $currentStatus['pending'] ?? 0 ?></h2>
        </div>
        <div style="font-size:2.5rem; color:#f59e0b; opacity:.15;"><i class="fas fa-hourglass-half"></i></div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card stat-box shadow-sm">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <p class="text-muted mb-2" style="font-size:.85rem; font-weight:600;">Total Spent</p>
          <h2 class="mb-0" style="color:#10b981; font-size:1.8rem;">₱<?= number_format($totalSpent ?? 0, 0) ?></h2>
        </div>
        <div style="font-size:2.5rem; color:#10b981; opacity:.15;"><i class="fas fa-wallet"></i></div>
      </div>
    </div>
  </div>
</div>

<!-- Featured Packages -->
<div class="mb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="section-title"><i class="fas fa-star me-2"></i>Available Tour Packages</h2>
    <a href="<?= base_url('packages') ?>" class="btn btn-outline-primary btn-sm">View All</a>
  </div>

  <?php if (empty($packages)): ?>
    <div class="empty-state">
      <i class="fas fa-inbox" style="font-size:3rem; color:#0066cc; opacity:.5;"></i>
      <h5 class="text-muted mt-3">No Packages Available</h5>
      <p class="text-muted">Check back soon for exciting tour packages!</p>
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach ($packages as $p): ?>
        <?php 
          $imgUrl = getImageUrl($p);
          $rate = (float)($p['rate_per_tourist'] ?? $p['price'] ?? 0);
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="card package-card">
            <!-- Package Image -->
            <img src="<?= esc($imgUrl) ?>" 
                 class="card-img-top" 
                 alt="<?= esc($p['title'] ?? 'Package') ?>" 
                 onerror="this.src='<?= getPlaceholderSvg('Package') ?>'">
            
            <div class="package-body">
              <div>
                <!-- Package Type Badge -->
                <div class="mb-3">
                  <span class="badge bg-primary" style="opacity:.8;">
                    <i class="fas fa-tag me-1"></i><?= ucfirst($p['type'] ?? 'Tour') ?>
                  </span>
                </div>

                <!-- Package Title -->
                <h5 class="card-title fw-bold mb-2"><?= esc($p['title'] ?? 'Package') ?></h5>
                
                <!-- Package Details -->
                <p class="card-text text-muted small">
                  <?= substr(esc($p['details'] ?? $p['description'] ?? ''), 0, 80) ?>
                  <?= (strlen($p['details'] ?? $p['description'] ?? '') > 80 ? '...' : '') ?>
                </p>

                <!-- Date Range -->
                <div style="font-size:.85rem; color:#64748b; margin-bottom:1rem;">
                  <i class="fas fa-calendar me-1"></i>
                  <?= date('M d', strtotime($p['date_from'] ?? 'now')) ?> - <?= date('M d, Y', strtotime($p['date_to'] ?? 'now')) ?>
                </div>
              </div>

              <!-- Price & Book Button -->
              <div class="price-section">
                <p class="text-muted small mb-2">Price Per Person</p>
                <h4 class="text-primary fw-bold mb-3">₱<?= number_format($rate, 2) ?></h4>
                
                <button type="button" 
                        class="btn btn-book btn-primary w-100" 
                        onclick="bookPackage(<?= $p['id'] ?>, '<?= addslashes(esc($p['title'])) ?>', <?= $rate ?>)">
                  <i class="fas fa-shopping-cart me-2"></i> Book Now
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<div class="section-divider"></div>

<!-- Tourist Spots -->
<div class="mb-5">
  <h2 class="section-title"><i class="fas fa-map-pin me-2" style="color:#ff6b6b;"></i>Popular Tourist Spots</h2>

  <?php if (empty($touristSpots)): ?>
    <div class="empty-state">
      <i class="fas fa-map" style="font-size:3rem; color:#ff6b6b; opacity:.5;"></i>
      <h5 class="text-muted mt-3">No Tourist Spots Listed</h5>
      <p class="text-muted">Explore destinations coming soon!</p>
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach(array_slice($touristSpots, 0, 6) as $spot): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card photo-card">
            <img src="<?= esc(getImageUrl($spot)) ?>" 
                 class="photo-card-img" 
                 alt="<?= esc($spot['name'] ?? 'Spot') ?>" 
                 onerror="this.src='<?= getPlaceholderSvg('Tourist Spot') ?>'">
            <div class="photo-card-body">
              <div class="photo-card-name">
                <i class="fas fa-map-pin me-2" style="color:#ff6b6b;"></i><?= esc($spot['name'] ?? '-') ?>
              </div>
              <div class="photo-card-info">
                <i class="fas fa-location-dot me-1"></i><?= esc($spot['location'] ?? '-') ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<div class="section-divider"></div>

<!-- Accommodations -->
<div class="mb-5">
  <h2 class="section-title"><i class="fas fa-hotel me-2" style="color:#00a8e8;"></i>Accommodations & Resorts</h2>

  <?php if (empty($accommodations)): ?>
    <div class="empty-state">
      <i class="fas fa-bed" style="font-size:3rem; color:#00a8e8; opacity:.5;"></i>
      <h5 class="text-muted mt-3">No Accommodations Available</h5>
      <p class="text-muted">Find your perfect stay soon!</p>
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach(array_slice($accommodations, 0, 6) as $acc): ?>
        <?php $nightPrice = $acc['price_per_night'] ?? $acc['price'] ?? 0; ?>
        <div class="col-md-6 col-lg-4">
          <div class="card photo-card">
            <img src="<?= esc(getImageUrl($acc)) ?>" 
                 class="photo-card-img" 
                 alt="<?= esc($acc['name'] ?? 'Accommodation') ?>" 
                 onerror="this.src='<?= getPlaceholderSvg('Accommodation') ?>'">
            <div class="photo-card-body">
              <div class="photo-card-name">
                <i class="fas fa-hotel me-2" style="color:#00a8e8;"></i><?= esc($acc['name'] ?? '-') ?>
              </div>
              <div class="photo-card-info">
                <i class="fas fa-location-dot me-1"></i><?= esc($acc['location'] ?? '-') ?>
              </div>
              <div class="price-badge">₱<?= number_format((float)$nightPrice, 0) ?>/night</div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<div class="section-divider"></div>

<!-- Tour Guides -->
<div class="mb-5">
  <h2 class="section-title"><i class="fas fa-user-tie me-2" style="color:#f59e0b;"></i>Expert Tour Guides</h2>

  <?php if (empty($tourGuides)): ?>
    <div class="empty-state">
      <i class="fas fa-users" style="font-size:3rem; color:#f59e0b; opacity:.5;"></i>
      <h5 class="text-muted mt-3">No Tour Guides Available</h5>
      <p class="text-muted">Professional guides coming soon!</p>
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach(array_slice($tourGuides, 0, 6) as $guide): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card photo-card">
            <img src="<?= esc(getImageUrl($guide)) ?>" 
                 class="photo-card-img" 
                 alt="<?= esc($guide['name'] ?? 'Guide') ?>" 
                 onerror="this.src='<?= getPlaceholderSvg('Tour Guide') ?>'">
            <div class="photo-card-body">
              <div class="photo-card-name">
                <i class="fas fa-user-tie me-2" style="color:#f59e0b;"></i><?= esc($guide['name'] ?? '-') ?>
              </div>
              <div class="photo-card-info"><?= esc($guide['expertise'] ?? 'Professional Guide') ?></div>
              <?php if (!empty($guide['email'])): ?>
                <div style="font-size:.85rem; color:#64748b; margin-top:.5rem;">
                  <i class="fas fa-envelope me-1"></i>
                  <a href="mailto:<?= esc($guide['email']) ?>" style="color:#0066cc; text-decoration:none;">
                    <?= esc($guide['email']) ?>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<div class="section-divider"></div>

<!-- Tour Agencies -->
<div class="mb-5">
  <h2 class="section-title"><i class="fas fa-briefcase me-2" style="color:#10b981;"></i>Tour Agencies & Partners</h2>

  <?php if (empty($tourAgencies)): ?>
    <div class="empty-state">
      <i class="fas fa-building" style="font-size:3rem; color:#10b981; opacity:.5;"></i>
      <h5 class="text-muted mt-3">No Tour Agencies Listed</h5>
      <p class="text-muted">Partner agencies coming soon!</p>
    </div>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach(array_slice($tourAgencies, 0, 6) as $agency): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card photo-card">
            <img src="<?= esc(getImageUrl($agency)) ?>" 
                 class="photo-card-img" 
                 alt="<?= esc($agency['name'] ?? 'Agency') ?>" 
                 onerror="this.src='<?= getPlaceholderSvg('Tour Agency') ?>'">
            <div class="photo-card-body">
              <div class="photo-card-name">
                <i class="fas fa-briefcase me-2" style="color:#10b981;"></i><?= esc($agency['name'] ?? '-') ?>
              </div>
              <div class="photo-card-info">
                <i class="fas fa-location-dot me-1"></i><?= esc($agency['address'] ?? 'N/A') ?>
              </div>
              <?php if (!empty($agency['contact'])): ?>
                <div style="font-size:.85rem; color:#64748b; margin-top:.5rem;">
                  <i class="fas fa-phone me-1"></i>
                  <a href="tel:<?= esc($agency['contact']) ?>" style="color:#0066cc; text-decoration:none;">
                    <?= esc($agency['contact']) ?>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function bookPackage(packageId, packageTitle, price) {
    Swal.fire({
      title: 'Confirm Booking',
      html: `<div style="text-align:left;">
               <p><strong>Package:</strong> ${packageTitle}</p>
               <p><strong>Price per Person:</strong> ₱${parseFloat(price).toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</p>
             </div>`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, Continue Booking',
      cancelButtonText: 'Cancel',
      confirmButtonColor: '#10b981',
      cancelButtonColor: '#ef4444'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '<?= base_url("bookings/book/") ?>' + packageId;
      }
    });
  }
</script>

<?= $this->endSection() ?>