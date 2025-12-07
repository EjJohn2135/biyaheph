
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
function getImageUrl($item = []) {
    if (!is_array($item)) return 'https://via.placeholder.com/400x300?text=No+Image';
    
    $img = $item['image'] ?? $item['photo'] ?? null;
    if (!$img) return 'https://via.placeholder.com/400x300?text=No+Image';
    
    $writablePath = WRITEPATH . 'uploads/' . $img;
    if (file_exists($writablePath)) {
        return base_url('writable/uploads/' . $img);
    }
    
    $publicPath = FCPATH . 'uploads/' . $img;
    if (file_exists($publicPath)) {
        return base_url('uploads/' . $img);
    }
    
    return 'https://via.placeholder.com/400x300?text=No+Image';
}
?>

<style>
  .booking-container {
    max-width: 800px;
    margin: 0 auto;
  }
  
  .package-header {
    background: linear-gradient(135deg, #0066cc 0%, #00a8e8 100%);
    color: white;
    border-radius: 1.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
  }
  
  .package-image {
    width: 100%;
    max-width: 400px;
    height: 250px;
    object-fit: cover;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
  }
  
  .form-section {
    background: #fff;
    border-radius: 1.2rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
  }
  
  .section-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #0066cc;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #00a8e8;
  }
  
  .form-label {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
  }
  
  .form-control:focus {
    border-color: #00a8e8;
    box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
  }
  
  .price-summary {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-left: 4px solid #0066cc;
    border-radius: 0.8rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
  }
  
  .summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.8rem;
    font-size: 0.95rem;
  }
  
  .summary-row.total {
    border-top: 2px solid #0066cc;
    padding-top: 0.8rem;
    margin-top: 0.8rem;
    font-size: 1.3rem;
    font-weight: 700;
    color: #0066cc;
  }
  
  .btn-submit {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    border-radius: 0.8rem;
    color: white;
    font-weight: 600;
    padding: 1rem 2rem;
    width: 100%;
    transition: all 0.3s ease;
  }
  
  .btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
  }
  
  .btn-cancel {
    background: #e2e8f0;
    border: none;
    border-radius: 0.8rem;
    color: #64748b;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    margin-top: 0.5rem;
  }
</style>

<div class="booking-container py-5">
  <!-- Back Button -->
  <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-outline-primary mb-4">
    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
  </a>

  <!-- Package Header -->
  <div class="package-header">
    <h1 style="font-size: 2rem; margin-bottom: 1rem;">
      <i class="fas fa-check-circle me-2"></i>Complete Your Booking
    </h1>
    <p style="opacity: 0.95;">Review package details and fill out your information below</p>
  </div>

  <!-- Package Summary -->
  <div class="form-section">
    <h2 class="section-title"><i class="fas fa-box me-2"></i>Package Details</h2>
    
    <div class="row">
      <div class="col-md-5">
        <img src="<?= esc(getImageUrl($package)) ?>" class="package-image" alt="<?= esc($package['title'] ?? 'Package') ?>" onerror="this.src='https://via.placeholder.com/400x300?text=Package'">
      </div>
      
      <div class="col-md-7">
        <h4 class="fw-bold mb-2"><?= esc($package['title'] ?? 'Tour Package') ?></h4>
        
        <p class="text-muted mb-3"><?= esc($package['description'] ?? $package['details'] ?? '') ?></p>
        
        <ul class="list-unstyled" style="font-size: 0.95rem;">
          <li class="mb-2">
            <i class="fas fa-tag me-2" style="color: #0066cc;"></i>
            <strong>Type:</strong> <?= ucfirst($package['type'] ?? 'Tour') ?>
          </li>
          <li class="mb-2">
            <i class="fas fa-calendar me-2" style="color: #0066cc;"></i>
            <strong>Date:</strong> <?= date('M d, Y', strtotime($package['date_from'] ?? '')) ?> - <?= date('M d, Y', strtotime($package['date_to'] ?? '')) ?>
          </li>
          <li class="mb-2">
            <i class="fas fa-users me-2" style="color: #0066cc;"></i>
            <strong>Max Tourists:</strong> <?= $package['max_tourists'] ?? 'N/A' ?>
          </li>
          <li>
            <i class="fas fa-money-bill me-2" style="color: #10b981;"></i>
            <strong>Price per Person:</strong> <span style="font-size: 1.3rem; color: #10b981; font-weight: 700;">₱<?= number_format((float)($package['rate_per_tourist'] ?? $package['price'] ?? 0), 2) ?></span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Booking Form -->
  <form method="POST" action="<?= site_url('bookings/store') ?>" class="booking-form">
    <?= csrf_field() ?>
    
    <!-- Hidden fields -->
    <input type="hidden" name="package_id" value="<?= $package['id'] ?? '' ?>">

    <!-- Number of Tourists -->
    <div class="form-section">
      <h2 class="section-title"><i class="fas fa-users me-2"></i>Number of Tourists</h2>
      
      <div class="mb-3">
        <label for="number_of_tourists" class="form-label">How many people are traveling? *</label>
        <input type="number" class="form-control form-control-lg" id="number_of_tourists" name="number_of_tourists" min="1" max="<?= $package['max_tourists'] ?? 50 ?>" value="1" required onchange="updateTotal()">
        <small class="form-text text-muted">Minimum: 1 | Maximum: <?= $package['max_tourists'] ?? 50 ?></small>
      </div>

      <div class="price-summary">
        <div class="summary-row">
          <span>Price per Person:</span>
          <span>₱<span id="pricePerPerson"><?= number_format((float)($package['rate_per_tourist'] ?? $package['price'] ?? 0), 2) ?></span></span>
        </div>
        <div class="summary-row">
          <span>Number of Persons:</span>
          <span id="numPersons">1</span>
        </div>
        <div class="summary-row total">
          <span>Total Price:</span>
          <span id="totalPrice">₱<?= number_format((float)($package['rate_per_tourist'] ?? $package['price'] ?? 0), 2) ?></span>
        </div>
      </div>
    </div>

    <!-- Contact Information -->
    <div class="form-section">
      <h2 class="section-title"><i class="fas fa-user me-2"></i>Your Contact Information</h2>
      
      <div class="mb-3">
        <label for="contact_name" class="form-label">Full Name *</label>
        <input type="text" class="form-control form-control-lg" id="contact_name" name="contact_name" placeholder="Enter your full name" required>
      </div>

      <div class="mb-3">
        <label for="contact_email" class="form-label">Email Address *</label>
        <input type="email" class="form-control form-control-lg" id="contact_email" name="contact_email" placeholder="your@email.com" required>
      </div>

      <div class="mb-3">
        <label for="contact_phone" class="form-label">Phone Number *</label>
        <input type="tel" class="form-control form-control-lg" id="contact_phone" name="contact_phone" placeholder="+63 9XX XXX XXXX" required>
      </div>
    </div>

    <!-- Special Requests -->
    <div class="form-section">
      <h2 class="section-title"><i class="fas fa-comment me-2"></i>Special Requests (Optional)</h2>
      
      <div class="mb-3">
        <label for="special_requests" class="form-label">Any special requests or preferences?</label>
        <textarea class="form-control" id="special_requests" name="special_requests" rows="4" placeholder="e.g., Dietary requirements, accessibility needs, etc."></textarea>
      </div>
    </div>

    <!-- Terms & Submit -->
    <div class="form-section">
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
        <label class="form-check-label" for="agreeTerms">
          I agree to the <a href="#" style="color: #0066cc; text-decoration: none;">terms and conditions</a> *
        </label>
      </div>

      <button type="submit" class="btn btn-submit">
        <i class="fas fa-check-circle me-2"></i>Confirm Booking
      </button>
      
      <a href="<?= base_url('dashboard') ?>" class="btn btn-cancel d-block text-center">
        Cancel
      </a>
    </div>
  </form>
</div>

<script>
  const ratePerTourist = <?= (float)($package['rate_per_tourist'] ?? $package['price'] ?? 0) ?>;

  function updateTotal() {
    const numTourists = parseInt(document.getElementById('number_of_tourists').value) || 1;
    const totalPrice = ratePerTourist * numTourists;
    
    document.getElementById('numPersons').textContent = numTourists;
    document.getElementById('totalPrice').innerHTML = '₱' + new Intl.NumberFormat('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(totalPrice);
  }

  // Update on page load
  updateTotal();
</script>

<?= $this->endSection() ?>