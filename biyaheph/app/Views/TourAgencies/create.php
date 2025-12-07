
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 2rem; border-radius: 1rem; margin-bottom: 2rem;">
  <h2 class="mb-1"><i class="fas fa-briefcase me-2"></i>Add New Tour Agency</h2>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-body">
        <form action="<?= base_url('touragencies/store') ?>" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="name" class="form-label fw-bold">Agency Name *</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= old('name') ?>">
          </div>

          <div class="mb-3">
            <label for="contact" class="form-label fw-bold">Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="+63212345678" value="<?= old('contact') ?>">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>">
          </div>

          <div class="mb-3">
            <label for="address" class="form-label fw-bold">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3"><?= old('address') ?></textarea>
          </div>

          <div class="mb-3">
            <label for="photo" class="form-label fw-bold">Photo</label>
            <div class="input-group">
              <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewImage(event, 'photoPreview')">
              <span class="input-group-text">JPG, PNG, GIF</span>
            </div>
            <small class="text-muted">Max 5MB</small>
            <div id="photoPreview" class="mt-2"></div>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save me-1"></i> Add Tour Agency
            </button>
            <a href="<?= base_url('touragencies') ?>" class="btn btn-secondary">
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