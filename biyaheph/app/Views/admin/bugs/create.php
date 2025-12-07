<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
  <a href="<?= base_url('admin/bugs') ?>" class="btn btn-secondary mb-3">
    <i class="fas fa-arrow-left me-1"></i> Back
  </a>
  <h2 style="font-size: 2rem; color: #0f172a;">
    <i class="fas fa-bug me-2" style="color: #dc2626;"></i>Report New Bug
  </h2>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm">
      <div class="card-body p-4">
        <form method="POST" action="<?= base_url('admin/bugs/store') ?>" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="module" class="form-label fw-bold">Module <span class="text-danger">*</span></label>
            <select name="module" id="module" class="form-select" required>
              <option value="">Select Module</option>
              <option value="Authentication">Authentication</option>
              <option value="Dashboard">Dashboard</option>
              <option value="Packages">Packages</option>
              <option value="Bookings">Bookings</option>
              <option value="Payments">Payments</option>
              <option value="Accommodations">Accommodations</option>
              <option value="Tourist Spots">Tourist Spots</option>
              <option value="Tour Guides">Tour Guides</option>
              <option value="Tour Agencies">Tour Agencies</option>
              <option value="Settings">Settings</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="title" class="form-label fw-bold">Bug Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Brief title of the bug" required>
            <small class="text-muted">Minimum 5 characters</small>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label fw-bold">Bug Description <span class="text-danger">*</span></label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Detailed description of the bug..." required></textarea>
            <small class="text-muted">Describe what happened and what was expected</small>
          </div>

          <div class="mb-3">
            <label for="steps_to_reproduce" class="form-label fw-bold">Steps to Reproduce <span class="text-danger">*</span></label>
            <textarea name="steps_to_reproduce" id="steps_to_reproduce" class="form-control" rows="4" placeholder="1. Step one&#10;2. Step two&#10;3. Step three" required></textarea>
            <small class="text-muted">List the exact steps to reproduce the bug</small>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="severity" class="form-label fw-bold">Severity <span class="text-danger">*</span></label>
              <select name="severity" id="severity" class="form-select" required>
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
                <option value="critical">Critical</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label for="assigned_to" class="form-label fw-bold">Assign To</label>
              <select name="assigned_to" id="assigned_to" class="form-select">
                <option value="">Unassigned</option>
                <?php foreach ($admins as $admin): ?>
                  <option value="<?= $admin['id'] ?>"><?= esc($admin['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="screenshot" class="form-label fw-bold">Screenshot (Optional)</label>
            <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/*">
            <small class="text-muted">Upload a screenshot showing the bug (Max 5MB, PNG/JPG/GIF)</small>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-check me-1"></i> Report Bug
            </button>
            <a href="<?= base_url('admin/bugs') ?>" class="btn btn-secondary">
              <i class="fas fa-times me-1"></i> Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card border-0 shadow-sm bg-light">
      <div class="card-body">
        <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Severity Guide</h5>
        <div class="mb-2">
          <span class="badge bg-danger">Critical</span>
          <small class="text-muted">System down, major functionality broken</small>
        </div>
        <div class="mb-2">
          <span class="badge bg-warning">High</span>
          <small class="text-muted">Significant feature not working</small>
        </div>
        <div class="mb-2">
          <span class="badge bg-info">Medium</span>
          <small class="text-muted">Minor feature issue or limitation</small>
        </div>
        <div class="mb-2">
          <span class="badge bg-success">Low</span>
          <small class="text-muted">Cosmetic or documentation issue</small>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>