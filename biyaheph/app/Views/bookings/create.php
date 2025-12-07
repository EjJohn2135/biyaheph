
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm">
  <div class="card-body">
    <h4 class="card-title mb-3">Book: <?= esc($package['title']) ?></h4>

    <div class="mb-3">
      <p class="mb-1 text-muted">Price per guest</p>
      <h5>₱<?= esc(number_format($package['price'],2)) ?></h5>
    </div>

    <form method="post" action="<?= base_url('bookings/store') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="package_id" value="<?= esc($package['id']) ?>">

      <div class="mb-3">
        <label class="form-label">Number of Guests</label>
        <input type="number" name="guests" id="guests" class="form-control" min="1" value="1" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Total</label>
        <div class="form-control" id="total">₱<?= esc(number_format($package['price'],2)) ?></div>
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-success">Proceed to Book</button>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const guests = document.getElementById('guests');
  const totalEl = document.getElementById('total');
  const price = <?= (float)$package['price'] ?>;

  function updateTotal() {
    const g = Math.max(1, parseInt(guests.value || 1));
    totalEl.textContent = '₱' + (price * g).toFixed(2);
  }
  guests.addEventListener('input', updateTotal);
});
</script>

<?= $this->endSection() ?>