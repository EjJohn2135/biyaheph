
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h4 class="card-title mb-3">
          <i class="fa fa-box me-2 text-primary"></i> <?= esc($package['title']) ?>
        </h4>

        <div class="row mb-4">
          <div class="col-md-4">
            <?php if (!empty($package['image'])): ?>
              <img src="<?= base_url('writable/uploads/'.$package['image']) ?>" class="img-fluid rounded" style="object-fit:cover;height:250px;">
            <?php endif; ?>
          </div>
          <div class="col-md-8">
            <table class="table table-borderless small">
              <tr>
                <td><strong>Type:</strong></td>
                <td><span class="badge bg-info"><?= ucfirst(esc($package['type'])) ?></span></td>
              </tr>
              <tr>
                <td><strong>Date:</strong></td>
                <td><?= date('M d, Y', strtotime($package['date_from'])) ?> - <?= date('M d, Y', strtotime($package['date_to'])) ?></td>
              </tr>
              <tr>
                <td><strong>Price per Tourist:</strong></td>
                <td><strong>₱<?= number_format($package['rate_per_tourist'], 2) ?></strong></td>
              </tr>
              <tr>
                <td><strong>Max Capacity:</strong></td>
                <td><?= esc($package['max_tourists']) ?> tourists</td>
              </tr>
            </table>

            <div class="mt-3">
              <h6>Description</h6>
              <p class="text-muted"><?= esc($package['description']) ?></p>
            </div>

            <?php if (!empty($package['details'])): ?>
              <div class="mt-3">
                <h6>Package Details</h6>
                <p class="text-muted small"><?= esc($package['details']) ?></p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Booking Form -->
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Complete Your Booking</h5>

        <form method="post" action="<?= base_url('bookings/store') ?>">
          <?= csrf_field() ?>
          <input type="hidden" name="package_id" value="<?= esc($package['id']) ?>">

          <div class="mb-3">
            <label class="form-label">Number of Tourists</label>
            <input class="form-control" type="number" name="number_of_tourists" min="1" max="<?= esc($package['max_tourists']) ?>" required value="<?= esc(old('number_of_tourists', 1)) ?>">
            <small class="text-muted">Max: <?= esc($package['max_tourists']) ?> tourists</small>
          </div>

          <div class="mb-3">
            <label class="form-label">Contact Name</label>
            <input class="form-control" type="text" name="contact_name" required value="<?= esc(old('contact_name', session()->get('name'))) ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Contact Email</label>
            <input class="form-control" type="email" name="contact_email" required value="<?= esc(old('contact_email', session()->get('email'))) ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Contact Phone</label>
            <input class="form-control" type="text" name="contact_phone" required value="<?= esc(old('contact_phone')) ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Special Requests (Optional)</label>
            <textarea class="form-control" name="special_requests" rows="3"><?= esc(old('special_requests')) ?></textarea>
          </div>

          <div class="alert alert-info">
            <strong>Estimated Total:</strong> ₱<span id="totalPrice">0.00</span>
          </div>

          <div class="d-grid gap-2">
            <button class="btn btn-success btn-lg">
              <i class="fa fa-check me-1"></i> Confirm Booking
            </button>
            <a href="<?= base_url('packages') ?>" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const ratePerTourist = <?= $package['rate_per_tourist'] ?>;
  const touristsInput = document.querySelector('input[name="number_of_tourists"]');
  const totalPriceSpan = document.getElementById('totalPrice');

  function updateTotal() {
    const tourists = parseInt(touristsInput.value) || 0;
    const total = tourists * ratePerTourist;
    totalPriceSpan.textContent = total.toFixed(2);
  }

  touristsInput.addEventListener('change', updateTotal);
  touristsInput.addEventListener('input', updateTotal);
  updateTotal();
});
</script>

<?= $this->endSection() ?>