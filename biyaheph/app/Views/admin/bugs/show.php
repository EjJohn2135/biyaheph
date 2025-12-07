
<?php if (! isset($bug)) { echo "Bug data not provided."; return; } ?>
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
  <a href="<?= base_url('admin/bugs') ?>" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Back
  </a>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white;">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
            <i class="fas fa-bug me-2"></i><?= esc($bug['bug_id']) ?>
          </h5>
          <div>
            <span class="badge bg-danger"><?= strtoupper($bug['severity']) ?></span>
            <span class="badge bg-info"><?= strtoupper(str_replace('_', ' ', $bug['status'])) ?></span>
          </div>
        </div>
      </div>

      <div class="card-body p-4">
        <h4 class="mb-3"><?= esc($bug['title']) ?></h4>

        <div class="row mb-4">
          <div class="col-md-6">
            <small class="text-muted d-block">Module</small>
            <strong><?= esc($bug['module']) ?></strong>
          </div>
          <div class="col-md-6">
            <small class="text-muted d-block">Reported By</small>
            <strong><?= esc($bug['reporter_name'] ?? $bug['reported_by'] ?? '-') ?></strong>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6">
            <small class="text-muted d-block">Created</small>
            <strong><?= !empty($bug['created_at']) ? date('M d, Y H:i', strtotime($bug['created_at'])) : '-' ?></strong>
          </div>
          <div class="col-md-6">
            <small class="text-muted d-block">Resolved</small>
            <strong><?= !empty($bug['resolved_at']) ? date('M d, Y H:i', strtotime($bug['resolved_at'])) : '-' ?></strong>
          </div>
        </div>

        <hr>

        <h6 class="mb-2">Description</h6>
        <p class="text-muted"><?= nl2br(esc($bug['description'])) ?></p>

        <h6 class="mb-2 mt-4">Steps to Reproduce</h6>
        <p class="text-muted"><?= nl2br(esc($bug['steps_to_reproduce'])) ?></p>

        <?php if (!empty($bug['screenshot'])): ?>
          <h6 class="mb-2 mt-4">Screenshot</h6>
          <div class="mb-3">
            <img src="<?= base_url('images/show/' . urlencode($bug['screenshot'])) ?>" alt="Screenshot" class="img-fluid" style="max-width: 100%; max-height: 400px; border-radius: 0.5rem;">
          </div>
        <?php endif; ?>

        <a href="<?= base_url('admin/bugs/edit/' . $bug['id']) ?>" class="btn btn-warning">
          <i class="fas fa-edit me-1"></i> Edit
        </a>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-light">
        <h5 class="mb-0">Quick Actions</h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label fw-bold">Change Status</label>
          <select class="form-select" id="statusSelect">
            <option value="open" <?= $bug['status'] === 'open' ? 'selected' : '' ?>>Open</option>
            <option value="in_progress" <?= $bug['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="resolved" <?= $bug['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
            <option value="closed" <?= $bug['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
          </select>
        </div>
        <button type="button" class="btn btn-primary w-100" onclick="updateStatus()">
          <i class="fas fa-save me-1"></i> Update Status
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const bugId = <?= $bug['id'] ?>;

async function updateStatus() {
  const status = document.getElementById('statusSelect').value;
  try {
    const response = await fetch(`<?= base_url('admin/bugs/updateStatus') ?>/${bugId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: `status=${status}`
    });

    if (response.ok) {
      Swal.fire({ icon: 'success', title: 'Success!', text: 'Bug status updated', timer: 1500 }).then(() => location.reload());
    } else {
      const data = await response.json();
      Swal.fire('Error', data.error || 'Failed to update status', 'error');
    }
  } catch (err) {
    Swal.fire('Error', 'Failed to update status', 'error');
  }
}
</script>

<?= $this->endSection() ?>