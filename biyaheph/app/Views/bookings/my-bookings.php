
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
  <h2 class="mb-1">My Bookings</h2>
  <p class="text-muted mb-0">View and manage your tour package bookings</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if (empty($bookings)): ?>
  <div class="alert alert-info">
    <i class="fa fa-info-circle me-2"></i> You haven't booked any packages yet. 
    <a href="<?= base_url('packages') ?>">Browse packages</a>
  </div>
<?php else: ?>
  <div class="row g-3">
    <?php foreach($bookings as $booking): 
      // Determine a safe display price: prefer total_price, fallback to package price, else show null
      $displayPrice = null;
      if (!empty($booking['total_price']) || $booking['total_price'] === '0' || $booking['total_price'] === 0) {
        $displayPrice = (float)$booking['total_price'];
      } elseif (!empty($booking['price'])) {
        $displayPrice = (float)$booking['price'];
      } elseif (!empty($booking['number_of_tourists']) && !empty($booking['rate_per_tourist'])) {
        $displayPrice = (float)$booking['number_of_tourists'] * (float)$booking['rate_per_tourist'];
      }
    ?>
      <div class="col-lg-6">
        <div class="card shadow-sm h-100">
          <?php if (!empty($booking['image'])): ?>
            <img src="<?= base_url('writable/uploads/'.$booking['image']) ?>" class="card-img-top" style="height:200px;object-fit:cover;" alt="<?= esc($booking['title']) ?>">
          <?php endif; ?>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title mb-0"><?= esc($booking['title']) ?></h5>
              <span class="badge bg-<?= $booking['status'] === 'approved' ? 'success' : ($booking['status'] === 'rejected' ? 'danger' : ($booking['status'] === 'cancelled' ? 'secondary' : 'warning')) ?>">
                <?= ucfirst(esc($booking['status'])) ?>
              </span>
            </div>

            <div class="small text-muted mb-3">
              <i class="fa fa-calendar me-1"></i> Booked on <?= date('M d, Y', strtotime($booking['created_at'])) ?>
            </div>

            <table class="table table-sm table-borderless">
              <tr>
                <td><strong>Number of Tourists:</strong></td>
                <td><?= esc($booking['number_of_tourists'] ?? 1) ?></td>
              </tr>
              <tr>
                <td><strong>Contact:</strong></td>
                <td><?= esc($booking['contact_name'] ?? '-') ?><br><small class="text-muted"><?= esc($booking['contact_email'] ?? '-') ?></small></td>
              </tr>
              <tr>
                <td><strong>Total Price:</strong></td>
                <td>
                  <?php if ($displayPrice !== null): ?>
                    <strong>₱<?= number_format($displayPrice, 2) ?></strong>
                  <?php else: ?>
                    <span class="text-muted">TBD</span>
                  <?php endif; ?>
                </td>
              </tr>
            </table>

            <?php if (!empty($booking['special_requests'])): ?>
              <div class="small mb-3">
                <strong>Special Requests:</strong>
                <p class="text-muted mb-0"><?= esc($booking['special_requests']) ?></p>
              </div>
            <?php endif; ?>

            <div class="btn-group w-100" role="group">
              <?php if ($booking['status'] === 'pending' && $booking['user_id'] == session()->get('id')): ?>
                <a href="#" class="btn btn-sm btn-outline-danger" onclick="cancelBooking(event, '<?= esc($booking['id']) ?>')">
                  <i class="fa fa-times me-1"></i> Cancel
                </a>
              <?php else: ?>
                <span class="text-muted small w-100 text-center">No actions available</span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<script>
function cancelBooking(e, bookingId) {
  e.preventDefault();
  if (!bookingId) return;
  Swal.fire({
    title: 'Cancel Booking?',
    text: 'Are you sure? This action cannot be undone.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    confirmButtonText: 'Yes, Cancel Booking',
    cancelButtonText: 'No, Keep It'
  }).then((result) => {
    if (result.isConfirmed) {
      // use server-side generated URL to avoid relying on undefined JS helpers
      window.location.href = '<?= site_url('bookings/cancel') ?>/' + encodeURIComponent(bookingId);
    }
  });
}
</script>

<?= $this->endSection() ?>