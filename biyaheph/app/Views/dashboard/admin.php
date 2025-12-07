
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  .stat-card {
    border: none;
    border-radius: 1rem;
    transition: all 0.3s ease;
    border-left: 4px solid #0066cc;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 102, 204, 0.15) !important;
  }

  .stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 0.8rem;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
  }

  .table thead th {
    background: linear-gradient(135deg, #0066cc 0%, #00a8e8 100%);
    color: white;
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
  }

  .table tbody tr:hover {
    background: #f0f9ff;
  }

  .btn-group-sm .btn {
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
  }
</style>

<div class="mb-5">
  <h2 style="font-size: 2.5rem; color: #0066cc; margin-bottom: 0.5rem;">
    <i class="fas fa-chart-line me-3"></i>Welcome, <?= esc(session()->get('name')) ?>
  </h2>
  <p class="text-muted" style="font-size: 1.1rem;">Manage your tourism platform with ease</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="card stat-card shadow-sm">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Packages</p>
            <h3 class="mb-0" style="color: #0066cc; font-size: 2rem;"><?= $totalPackages ?? 0 ?></h3>
          </div>
          <div class="stat-icon" style="background: linear-gradient(135deg, rgba(0, 102, 204, 0.1), rgba(0, 168, 232, 0.1));">
            <i class="fas fa-box-open" style="color: #0066cc; font-size: 1.8rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card stat-card shadow-sm" style="border-left-color: #10b981;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Bookings</p>
            <h3 class="mb-0" style="color: #10b981; font-size: 2rem;"><?= $totalBookings ?? 0 ?></h3>
          </div>
          <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));">
            <i class="fas fa-calendar-check" style="color: #10b981; font-size: 1.8rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card stat-card shadow-sm" style="border-left-color: #f59e0b;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Revenue</p>
            <h3 class="mb-0" style="color: #f59e0b; font-size: 2rem;">₱<?= number_format($totalRevenue ?? 0, 0) ?></h3>
          </div>
          <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));">
            <i class="fas fa-coins" style="color: #f59e0b; font-size: 1.8rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-3">
    <div class="card stat-card shadow-sm" style="border-left-color: #ff6b6b;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Pending Bookings</p>
            <h3 class="mb-0" style="color: #ff6b6b; font-size: 2rem;"><?= $pendingBookings ?? 0 ?></h3>
          </div>
          <div class="stat-icon" style="background: linear-gradient(135deg, rgba(255, 107, 107, 0.1), rgba(239, 68, 68, 0.1));">
            <i class="fas fa-hourglass-end" style="color: #ff6b6b; font-size: 1.8rem;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mb-5">
  <div class="col-md-4">
    <a href="<?= base_url('packages/create') ?>" class="card border-0 shadow-sm text-decoration-none text-dark hover-shadow" style="border-radius: 1rem;">
      <div class="card-body text-center py-5">
        <div style="font-size: 2.5rem; margin-bottom: 1rem; color: #0066cc;">
          <i class="fas fa-plus-circle"></i>
        </div>
        <h6 class="card-title mb-2" style="font-size: 1rem;">Add Package</h6>
        <p class="card-text text-muted small">Create new tour package</p>
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="<?= base_url('packages') ?>" class="card border-0 shadow-sm text-decoration-none text-dark hover-shadow" style="border-radius: 1rem;">
      <div class="card-body text-center py-5">
        <div style="font-size: 2.5rem; margin-bottom: 1rem; color: #00a8e8;">
          <i class="fas fa-list"></i>
        </div>
        <h6 class="card-title mb-2" style="font-size: 1rem;">Manage Packages</h6>
        <p class="card-text text-muted small">Edit or delete packages</p>
      </div>
    </a>
  </div>

  <div class="col-md-4">
    <a href="<?= base_url('bookings/manage') ?>" class="card border-0 shadow-sm text-decoration-none text-dark hover-shadow" style="border-radius: 1rem;">
      <div class="card-body text-center py-5">
        <div style="font-size: 2.5rem; margin-bottom: 1rem; color: #10b981;">
          <i class="fas fa-check-circle"></i>
        </div>
        <h6 class="card-title mb-2" style="font-size: 1rem;">Manage Bookings</h6>
        <p class="card-text text-muted small">Approve or review bookings</p>
      </div>
    </a>
  </div>
</div>

<!-- Pending Admin Requests -->
<div class="card border-0 shadow-sm" style="border-radius: 1rem; border-top: 4px solid #0066cc;">
  <div class="card-header" style="background: linear-gradient(135deg, #0066cc 0%, #00a8e8 100%); color: white; border-radius: 1rem 1rem 0 0;">
    <div class="d-flex align-items-center justify-content-between">
      <h5 class="mb-0" style="color: white;">
        <i class="fas fa-user-shield me-2"></i>Pending Admin Requests
      </h5>
      <?php if (!empty($pendingAdmins)): ?>
        <span class="badge bg-danger" style="padding: 0.6rem 0.9rem; font-size: 0.9rem;"><?= count($pendingAdmins) ?></span>
      <?php endif; ?>
    </div>
  </div>

  <div class="card-body">
    <?php if (empty($pendingAdmins)): ?>
      <div class="text-center py-5">
        <i class="fas fa-check-circle" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;"></i>
        <p class="text-muted" style="font-size: 1.05rem;">No pending admin requests</p>
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Requested</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($pendingAdmins as $index => $pa): ?>
              <tr>
                <td class="fw-bold"><?= $index + 1 ?></td>
                <td><strong><?= esc($pa['name']) ?></strong></td>
                <td><small class="text-muted"><?= esc($pa['email']) ?></small></td>
                <td><small class="text-muted"><?= date('M d, Y', strtotime($pa['created_at'] ?? 'now')) ?></small></td>
                <td>
                  <div class="btn-group btn-group-sm" role="group">
                    <button 
                      type="button" 
                      class="btn btn-success"
                      onclick="approveAdmin('<?= esc($pa['name']) ?>', '<?= $pa['id'] ?>')">
                      <i class="fas fa-check me-1"></i> Approve
                    </button>
                    <button 
                      type="button" 
                      class="btn btn-outline-danger"
                      onclick="rejectAdmin('<?= esc($pa['name']) ?>', '<?= $pa['id'] ?>')">
                      <i class="fas fa-times me-1"></i> Reject
                    </button>
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
function approveAdmin(name, id) {
  Swal.fire({
    title: 'Approve Admin?',
    text: `Approve "${name}" as an admin?`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#10b981',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Approve!',
    cancelButtonText: 'Cancel',
    background: '#fff',
    customClass: {
      popup: 'rounded-3'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      // Create a form and submit it
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '<?= base_url('auth/approveAdmin') ?>';
      
      const idInput = document.createElement('input');
      idInput.type = 'hidden';
      idInput.name = 'id';
      idInput.value = id;
      
      const csrfInput = document.createElement('input');
      csrfInput.type = 'hidden';
      csrfInput.name = '<?= csrf_token() ?>';
      csrfInput.value = '<?= csrf_hash() ?>';
      
      form.appendChild(idInput);
      form.appendChild(csrfInput);
      document.body.appendChild(form);
      form.submit();
    }
  });
}

function rejectAdmin(name, id) {
  Swal.fire({
    title: 'Reject Request?',
    text: `This will delete "${name}"'s account. This action cannot be undone.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#ef4444',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Reject!',
    cancelButtonText: 'Cancel',
    background: '#fff',
    customClass: {
      popup: 'rounded-3'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      // Create a form and submit it
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '<?= base_url('auth/rejectAdmin') ?>';
      
      const idInput = document.createElement('input');
      idInput.type = 'hidden';
      idInput.name = 'id';
      idInput.value = id;
      
      const csrfInput = document.createElement('input');
      csrfInput.type = 'hidden';
      csrfInput.name = '<?= csrf_token() ?>';
      csrfInput.value = '<?= csrf_hash() ?>';
      
      form.appendChild(idInput);
      form.appendChild(csrfInput);
      document.body.appendChild(form);
      form.submit();
    }
  });
}
</script>

<?= $this->endSection() ?>