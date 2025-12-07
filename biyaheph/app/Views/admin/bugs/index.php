<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  .stat-card { border: none; border-radius: 1rem; transition: all 0.3s ease; border-top: 4px solid; }
  .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
  .stat-card.critical { border-top-color: #dc2626; }
  .stat-card.high { border-top-color: #f97316; }
  .stat-card.medium { border-top-color: #eab308; }
  .stat-card.low { border-top-color: #10b981; }

  .bug-row { transition: all 0.2s ease; }
  .bug-row:hover { background-color: #f8fafc; }

  .severity-badge { padding: 0.4rem 0.8rem; border-radius: 0.4rem; font-weight: 600; font-size: 0.75rem; }
  .severity-critical { background: #fecaca; color: #7f1d1d; }
  .severity-high { background: #fed7aa; color: #7c2d12; }
  .severity-medium { background: #fef08a; color: #713f12; }
  .severity-low { background: #dcfce7; color: #15803d; }

  .status-badge { padding: 0.3rem 0.6rem; border-radius: 0.3rem; font-weight: 600; font-size: 0.75rem; }
  .status-open { background: #dbeafe; color: #0c4a6e; }
  .status-in_progress { background: #e0e7ff; color: #3730a3; }
  .status-resolved { background: #d1fae5; color: #065f46; }
  .status-closed { background: #f3f4f6; color: #374151; }
</style>

<div class="mb-5">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h2 style="font-size: 2rem; color: #0f172a; margin-bottom: 0.5rem;">
        <i class="fas fa-bug me-3" style="color: #dc2626;"></i>Bug Logs
      </h2>
      <p class="text-muted">Track and manage reported bugs</p>
    </div>
    <div class="d-flex gap-2">
      <a href="<?= base_url('admin/bugs/create') ?>" class="btn btn-danger">
        <i class="fas fa-plus me-1"></i> Report Bug
      </a>
      <a href="<?= base_url('admin/bugs/export') ?>" class="btn btn-secondary">
        <i class="fas fa-download me-1"></i> Export CSV
      </a>
    </div>
  </div>
</div>

<!-- Statistics -->
<div class="row g-3 mb-4">
  <div class="col-md-3">
    <div class="card stat-card critical">
      <div class="card-body">
        <p class="text-muted small mb-1">Critical Issues</p>
        <h3 class="mb-0" style="color: #dc2626;"><?= $stats['critical'] ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card stat-card high">
      <div class="card-body">
        <p class="text-muted small mb-1">High Priority</p>
        <h3 class="mb-0" style="color: #f97316;"><?= $stats['high'] ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card stat-card medium">
      <div class="card-body">
        <p class="text-muted small mb-1">Medium Issues</p>
        <h3 class="mb-0" style="color: #eab308;"><?= $stats['medium'] ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card stat-card low">
      <div class="card-body">
        <p class="text-muted small mb-1">Low Priority</p>
        <h3 class="mb-0" style="color: #10b981;"><?= $stats['low'] ?></h3>
      </div>
    </div>
  </div>
</div>

<!-- Status Overview -->
<div class="row g-3 mb-4">
  <div class="col-md-2">
    <div class="card text-center">
      <div class="card-body">
        <h4 class="mb-1"><?= $stats['open'] ?></h4>
        <small class="text-muted">Open</small>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card text-center">
      <div class="card-body">
        <h4 class="mb-1"><?= $stats['in_progress'] ?></h4>
        <small class="text-muted">In Progress</small>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card text-center">
      <div class="card-body">
        <h4 class="mb-1"><?= $stats['resolved'] ?></h4>
        <small class="text-muted">Resolved</small>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card text-center">
      <div class="card-body">
        <h4 class="mb-1"><?= $stats['closed'] ?></h4>
        <small class="text-muted">Closed</small>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="card text-center">
      <div class="card-body">
        <h4 class="mb-1"><?= $stats['total'] ?></h4>
        <small class="text-muted">Total</small>
      </div>
    </div>
  </div>
</div>

<!-- Filters & Search -->
<div class="card border-0 shadow-sm mb-4">
  <div class="card-body">
    <form method="GET" class="row g-3">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search bug ID, title, module..." value="<?= $search ?>">
      </div>
      <div class="col-md-2">
        <select name="status" class="form-select">
          <option value="">All Status</option>
          <option value="open" <?= $currentStatus === 'open' ? 'selected' : '' ?>>Open</option>
          <option value="in_progress" <?= $currentStatus === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
          <option value="resolved" <?= $currentStatus === 'resolved' ? 'selected' : '' ?>>Resolved</option>
          <option value="closed" <?= $currentStatus === 'closed' ? 'selected' : '' ?>>Closed</option>
        </select>
      </div>
      <div class="col-md-2">
        <select name="severity" class="form-select">
          <option value="">All Severity</option>
          <option value="critical" <?= $currentSeverity === 'critical' ? 'selected' : '' ?>>Critical</option>
          <option value="high" <?= $currentSeverity === 'high' ? 'selected' : '' ?>>High</option>
          <option value="medium" <?= $currentSeverity === 'medium' ? 'selected' : '' ?>>Medium</option>
          <option value="low" <?= $currentSeverity === 'low' ? 'selected' : '' ?>>Low</option>
        </select>
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-filter me-1"></i> Filter
        </button>
        <a href="<?= base_url('admin/bugs') ?>" class="btn btn-secondary">
          <i class="fas fa-times me-1"></i> Clear
        </a>
      </div>
    </form>
  </div>
</div>

<!-- Bugs Table -->
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white;">
        <tr>
          <th>Bug ID</th>
          <th>Module</th>
          <th>Title</th>
          <th>Severity</th>
          <th>Status</th>
          <th>Reported By</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($bugs)): ?>
          <?php foreach ($bugs as $bug): ?>
            <tr class="bug-row">
              <td>
                <strong style="color: #dc2626;"><?= esc($bug['bug_id']) ?></strong>
              </td>
              <td>
                <span class="badge bg-info"><?= esc($bug['module']) ?></span>
              </td>
              <td>
                <div style="max-width: 250px;">
                  <strong><?= esc(substr($bug['title'], 0, 50)) ?></strong>
                  <?php if (strlen($bug['title']) > 50): ?>
                    <small class="text-muted">...</small>
                  <?php endif; ?>
                </div>
              </td>
              <td>
                <span class="severity-badge severity-<?= $bug['severity'] ?>">
                  <?= strtoupper($bug['severity']) ?>
                </span>
              </td>
              <td>
                <span class="status-badge status-<?= $bug['status'] ?>">
                  <?= ucfirst(str_replace('_', ' ', $bug['status'])) ?>
                </span>
              </td>
              <td>
                <small><?= esc($bug['reporter_name']) ?></small>
              </td>
              <td>
                <small class="text-muted"><?= date('M d, Y', strtotime($bug['created_at'])) ?></small>
              </td>
              <td>
                <div class="btn-group btn-group-sm" role="group">
                  <a href="<?= base_url('admin/bugs/show/' . $bug['id']) ?>" class="btn btn-info" title="View">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a href="<?= base_url('admin/bugs/edit/' . $bug['id']) ?>" class="btn btn-warning" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <button type="button" class="btn btn-danger" title="Delete" onclick="deleteBug(<?= $bug['id'] ?>, '<?= esc($bug['bug_id']) ?>')">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center py-5">
              <i class="fas fa-inbox" style="font-size: 2rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
              <p class="text-muted">No bugs found</p>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($pager): ?>
    <div class="card-footer bg-light">
      <?= $pager->links() ?>
    </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteBug(id, bugId) {
  Swal.fire({
    title: 'Delete Bug Report?',
    text: `Are you sure you want to delete "${bugId}"? This action cannot be undone.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc2626',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Delete',
    cancelButtonText: 'Cancel',
    background: '#fff'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '<?= base_url('admin/bugs/delete') ?>/' + id;
    }
  });
}
</script>

<?= $this->endSection() ?>