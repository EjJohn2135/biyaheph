
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 2rem; border-radius: 1rem; margin-bottom: 2rem;">
  <h2 class="mb-1"><i class="fas fa-user-tie me-2"></i>Edit Tour Guide</h2>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-body">
        <form action="<?= base_url('tourguides/update/'.$guide['id']) ?>" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="name" class="form-label fw-bold">Guide Name *</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= esc($guide['name']) ?>">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= esc($guide['email']) ?>">
          </div>

          <div class="mb-3">
            <label for="contact" class="form-label fw-bold">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?= esc($guide['contact']) ?>">
          </div>

          <div class="mb-3">
            <label for="expertise" class="form-label fw-bold">Expertise</label>
            <input type="text" class="form-control" id="expertise" name="expertise" value="<?= esc($guide['expertise']) ?>">
          </div>

          <div class="mb-3">
            <label for="photo" class="form-label fw-bold">Photo</label>
            <?php if (!empty($guide['photo']) && file_exists(WRITEPATH.'uploads/'.$guide['photo'])): ?>
              <div class="mb-2">
                <img src="<?= base_url('writable/uploads/' . $guide['photo']) ?>" alt="Current photo" style="max-width: 200px; border-radius: 0.5rem; display: block;">
                <small class="text-muted">Current photo</small>
              </div>
            <?php endif; ?>
            <div class="input-group">
              <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(event, 'photoPreview')">
              <span class="input-group-text">Change Photo</span>
            </div>
            <small class="text-muted">Leave empty to keep current photo</small>
            <div id="photoPreview" class="mt-2"></div>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning">
              <i class="fas fa-save me-1"></i> Update Tour Guide
            </button>
            <a href="<?= base_url('tourguides') ?>" class="btn btn-secondary">
              <i class="fas fa-times me-1"></i> Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function previewImage(event, previewId) {
  const file = event.target.files[0];
  const preview = document.getElementById(previewId);
  
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.innerHTML = `<img src="${e.target.result}" style="max-width: 200px; border-radius: 0.5rem;">`;
    };
    reader.readAsDataURL(file);
  }
}
</script>

<?= $this->endSection() ?>