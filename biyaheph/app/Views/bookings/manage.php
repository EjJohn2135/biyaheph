
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h2 class="mb-1">Manage Bookings</h2>
    <p class="text-muted mb-0">View and manage all customer bookings</p>
  </div>
  <div>
    <a href="<?= site_url('bookings/exportCSV') ?>" class="btn btn-primary">
      <i class="fa fa-download me-2"></i> Export Approved to CSV
    </a>
  </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<!-- Status Filter Tabs -->
<div class="mb-4">
  <div class="btn-group" role="group">
    <a href="<?= site_url('bookings/manage') ?>" class="btn btn-outline-primary <?= !$currentStatus ? 'active' : '' ?>">
      <i class="fa fa-list me-1"></i> All
    </a>
    <a href="<?= site_url('bookings/manage?status=pending') ?>" class="btn btn-outline-warning <?= $currentStatus === 'pending' ? 'active' : '' ?>">
      <i class="fa fa-clock me-1"></i> Pending
    </a>
    <a href="<?= site_url('bookings/manage?status=approved') ?>" class="btn btn-outline-success <?= $currentStatus === 'approved' ? 'active' : '' ?>">
      <i class="fa fa-check me-1"></i> Approved
    </a>
    <a href="<?= site_url('bookings/manage?status=rejected') ?>" class="btn btn-outline-danger <?= $currentStatus === 'rejected' ? 'active' : '' ?>">
      <i class="fa fa-times me-1"></i> Rejected
    </a>
    <a href="<?= site_url('bookings/manage?status=cancelled') ?>" class="btn btn-outline-secondary <?= $currentStatus === 'cancelled' ? 'active' : '' ?>">
      <i class="fa fa-ban me-1"></i> Cancelled
    </a>
  </div>
</div>

<!-- Bookings Table -->
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <?php if (empty($bookings)): ?>
      <div class="text-center py-5">
        <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
        <p class="text-muted">No bookings found for this filter.</p>
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr class="text-muted small">
              <th>#</th>
              <th>Customer</th>
              <th>Package</th>
              <th>Guests</th>
              <th>Total</th>
              <th>Status</th>
              <th>Booked On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($bookings as $index => $b): ?>
              <tr>
                <td class="fw-bold"><?= $b['id'] ?></td>
                <td><?= esc($b['user_name'] ?? '—') ?></td>
                <td><?= esc($b['package_title'] ?? '—') ?></td>
                <td><?= esc($b['number_of_tourists'] ?? '—') ?></td>
                <td class="fw-bold">₱<?= esc(number_format($b['total_price'] ?? 0, 2)) ?></td>
                <td>
                  <?php 
                    $statusClass = [
                      'pending' => 'warning',
                      'approved' => 'success',
                      'rejected' => 'danger',
                      'cancelled' => 'secondary'
                    ][$b['status']] ?? 'secondary';
                  ?>
                  <span class="badge bg-<?= $statusClass ?>"><?= ucfirst($b['status']) ?></span>
                </td>
                <td>
                  <small class="text-muted"><?= date('M d, Y', strtotime($b['created_at'])) ?></small>
                </td>
                <td>
                  <div class="btn-group btn-group-sm" role="group">
                    <?php if ($b['status'] === 'pending'): ?>
                      <a href="<?= site_url('bookings/approve/'.$b['id']) ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-check me-1"></i> Approve
                      </a>
                      <a href="<?= site_url('bookings/reject/'.$b['id']) ?>" class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-times me-1"></i> Reject
                      </a>
                    <?php else: ?>
                      <span class="badge bg-secondary"><?= ucfirst($b['status']) ?></span>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function confirmBooking(e, bookingId) {
  e.preventDefault();
  Swal.fire({
    title: 'Confirm Booking?',
    text: 'Mark this booking as confirmed?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    confirmButtonText: 'Yes, Confirm',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '<?= site_url('bookings/approve/') ?>' + bookingId;
    }
  });
}

function cancelBooking(e, bookingId) {
  e.preventDefault();
  Swal.fire({
    title: 'Cancel Booking?',
    text: 'This action will mark the booking as cancelled.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    confirmButtonText: 'Yes, Cancel',
    cancelButtonText: 'Keep Booking'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '<?= site_url('bookings/cancel/') ?>' + bookingId;
    }
  });
}
</script>

<?= $this->endSection() ?>