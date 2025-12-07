
<?php if (! isset($bug)) { echo "Bug data not provided."; return; } ?>
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
  <a href="<?= base_url('admin/bugs') ?>" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Back
  </a>
  <h2 style="font-size: 1.75rem; color: #0f172a;">
    <i class="fas fa-edit me-2" style="color: #f59e0b;"></i>Edit Bug - <?= esc($bug['bug_id']) ?>
  </h2>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm">
      <div class="card-body p-4">
        <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form method="POST" action="<?= base_url('admin/bugs/update/' . $bug['id']) ?>" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="module" class="form-label fw-bold">Module</label>
            <select name="module" id="module" class="form-select" required>
              <?php $modules = ['Authentication','Dashboard','Packages','Bookings','Payments','Accommodations','Tourist Spots','Tour Guides','Tour Agencies','Settings','System','Other']; ?>
              <option value="">Select Module</option>
              <?php foreach ($modules as $m): ?>
                <option value="<?= esc($m) ?>" <?= $bug['module'] === $m ? 'selected' : '' ?>><?= esc($m) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= esc($bug['title']) ?>" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required><?= esc($bug['description']) ?></textarea>
          </div>

          <div class="mb-3">
            <label for="steps_to_reproduce" class="form-label fw-bold">Steps to Reproduce</label>
            <textarea name="steps_to_reproduce" id="steps_to_reproduce" class="form-control" rows="4"><?= esc($bug['steps_to_reproduce']) ?></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="severity" class="form-label fw-bold">Severity</label>
              <select name="severity" id="severity" class="form-select" required>
                <option value="critical" <?= $bug['severity'] === 'critical' ? 'selected' : '' ?>>Critical</option>
                <option value="high" <?= $bug['severity'] === 'high' ? 'selected' : '' ?>>High</option>
                <option value="medium" <?= $bug['severity'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                <option value="low" <?= $bug['severity'] === 'low' ? 'selected' : '' ?>>Low</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="status" class="form-label fw-bold">Status</label>
              <select name="status" id="status" class="form-select" required>
                <option value="open" <?= $bug['status'] === 'open' ? 'selected' : '' ?>>Open</option>
                <option value="in_progress" <?= $bug['status'] === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="resolved" <?= $bug['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                <option value="closed" <?= $bug['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="assigned_to" class="form-label fw-bold">Assign To</label>
            <select name="assigned_to" id="assigned_to" class="form-select">
              <option value="">Unassigned</option>
              <?php if (! empty($admins)): foreach ($admins as $admin): ?>
                <option value="<?= $admin['id'] ?>" <?= isset($bug['assigned_to']) && $bug['assigned_to'] == $admin['id'] ? 'selected' : '' ?>><?= esc($admin['name']) ?></option>
              <?php endforeach; endif; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Screenshot (Optional)</label>
            <?php if (!empty($bug['screenshot'])): ?>
              <div class="mb-2">
                <img id="currentScreenshot" src="<?= base_url('images/show/' . urlencode($bug['screenshot'])) ?>" alt="Screenshot" style="max-width: 260px; border-radius: 6px; display:block; margin-bottom:10px;">
                <div class="form-check mb-2">
                  <input class="form-check-input" type="checkbox" name="remove_screenshot" id="remove_screenshot" value="1">
                  <label class="form-check-label" for="remove_screenshot">Remove existing screenshot</label>
                </div>
              </div>
            <?php endif; ?>

            <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/*">
            <small class="text-muted">Upload a new screenshot to replace the existing one (Max 5MB).</small>

            <div class="mt-2">
              <img id="preview" src="#" alt="Preview" style="display:none; max-width:260px; border-radius:6px;">
            </div>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning">
              <i class="fas fa-save me-1"></i> Update Bug
            </button>
            <a href="<?= base_url('admin/bugs') ?>" class="btn btn-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card border-0 shadow-sm bg-light">
      <div class="card-body">
        <h6 class="mb-3">Report Info</h6>
        <div class="mb-2"><small class="text-muted">Bug ID</small><div><?= esc($bug['bug_id']) ?></div></div>
        <div class="mb-2"><small class="text-muted">Reported By</small><div><?= esc($bug['reported_by'] ?? '-') ?></div></div>
        <div class="mb-2"><small class="text-muted">Created</small><div><?= !empty($bug['created_at']) ? date('M d, Y H:i', strtotime($bug['created_at'])) : '-' ?></div></div>
        <div class="mb-2"><small class="text-muted">Resolved At</small><div><?= !empty($bug['resolved_at']) ? date('M d, Y H:i', strtotime($bug['resolved_at'])) : '-' ?></div></div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('screenshot').addEventListener('change', function (evt) {
  const file = evt.target.files[0];
  const preview = document.getElementById('preview');
  if (!file) {
    preview.style.display = 'none';
    return;
  }
  const reader = new FileReader();
  reader.onload = function(e) {
    preview.src = e.target.result;
    preview.style.display = 'block';
  };
  reader.readAsDataURL(file);
});
</script>

<?= $this->endSection() ?>