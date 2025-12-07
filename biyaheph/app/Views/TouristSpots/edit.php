
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; padding: 2rem; border-radius: 1rem; margin-bottom: 2rem;">
  <h2 class="mb-1"><i class="fas fa-map-pin me-2"></i>Edit Tourist Spot</h2>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card shadow">
      <div class="card-body">
        <form action="<?= base_url('touristspots/update/'.$spot['id']) ?>" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="name" class="form-label fw-bold">Spot Name *</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= esc($spot['name']) ?>">
          </div>

          <div class="mb-3">
            <label for="location" class="form-label fw-bold">Location *</label>
            <input type="text" class="form-control" id="location" name="location" required value="<?= esc($spot['location']) ?>">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?= esc($spot['description']) ?></textarea>
          </div>

          <div class="mb-3">
            <label for="photo" class="form-label fw-bold">Photo</label>
            <?php if (!empty($spot['photo']) && file_exists(WRITEPATH.'uploads/'.$spot['photo'])): ?>
              <div class="mb-2">
                <img src="<?= base_url('writable/uploads/' . $spot['photo']) ?>" alt="Current photo" style="max-width: 200px; border-radius: 0.5rem; display: block;">
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
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-save me-1"></i> Update Tourist Spot
            </button>
            <a href="<?= base_url('touristspots') ?>" class="btn btn-secondary">
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