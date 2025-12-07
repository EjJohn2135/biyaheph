
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title mb-3">Add New Tour Package</h4>

        <form method="post" action="<?= base_url('packages/store') ?>" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <!-- Basic Info -->
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="title" required value="<?= esc(old('title')) ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea class="form-control" name="details" rows="4" required><?= esc(old('details')) ?></textarea>
          </div>

          <!-- Type & Dates -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Package Type</label>
              <select class="form-select" name="type" required>
                <option value="">Select Type</option>
                <option value="joiner" <?= old('type') === 'joiner' ? 'selected' : '' ?>>Joiner</option>
                <option value="exclusive" <?= old('type') === 'exclusive' ? 'selected' : '' ?>>Exclusive</option>
              </select>
              <small class="text-muted">Joiner: Multiple groups can join. Exclusive: Private group only.</small>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Image</label>
              <input class="form-control" type="file" name="image" accept="image/*">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Date From</label>
              <input class="form-control" type="date" name="date_from" value="<?= esc(old('date_from')) ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Date To</label>
              <input class="form-control" type="date" name="date_to" value="<?= esc(old('date_to')) ?>">
            </div>
          </div>

          <!-- Pricing -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Price (Total)</label>
              <input class="form-control" type="number" step="0.01" name="price" required value="<?= esc(old('price')) ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Rate per Tourist</label>
              <input class="form-control" type="number" step="0.01" name="rate_per_tourist" value="<?= esc(old('rate_per_tourist')) ?>">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Max Tourists</label>
            <input class="form-control" type="number" name="max_tourists" value="50" value="<?= esc(old('max_tourists')) ?>">
          </div>

          <!-- Relations -->
          <div class="mb-3">
            <label class="form-label">Accommodation</label>
            <select class="form-select" name="accommodation_id">
              <option value="">Select Accommodation</option>
              <?php foreach($accommodations as $acc): ?>
                <option value="<?= $acc['id'] ?>" <?= old('accommodation_id') == $acc['id'] ? 'selected' : '' ?>>
                  <?= esc($acc['name']) ?> - ₱<?= number_format($acc['price_per_night'], 2) ?>/night
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Tour Agency</label>
            <select class="form-select" name="tour_agency_id">
              <option value="">Select Tour Agency</option>
              <?php foreach($tourAgencies as $ta): ?>
                <option value="<?= $ta['id'] ?>" <?= old('tour_agency_id') == $ta['id'] ? 'selected' : '' ?>>
                  <?= esc($ta['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Tour Guide</label>
            <select class="form-select" name="tour_guide_id">
              <option value="">Select Tour Guide</option>
              <?php foreach($tourGuides as $tg): ?>
                <option value="<?= $tg['id'] ?>" <?= old('tour_guide_id') == $tg['id'] ? 'selected' : '' ?>>
                  <?= esc($tg['name']) ?> (<?= esc($tg['expertise']) ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Tourist Spots - Unlimited Selection -->
          <div class="mb-3">
            <label class="form-label">
              <i class="fa fa-map-pin me-1"></i> Tourist Spots
              <span class="badge bg-info">Select Multiple</span>
            </label>
            <div class="border p-3 rounded" style="max-height:300px;overflow-y:auto;background-color:#f8f9fa;">
              <?php if (empty($touristSpots)): ?>
                <p class="text-muted mb-0"><i class="fa fa-info-circle me-1"></i> No tourist spots registered yet.</p>
              <?php else: ?>
                <?php foreach($touristSpots as $spot): ?>
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="tourist_spots[]" value="<?= $spot['id'] ?>" id="spot_<?= $spot['id'] ?>" <?= in_array($spot['id'], (array)old('tourist_spots', [])) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="spot_<?= $spot['id'] ?>">
                      <strong><?= esc($spot['name']) ?></strong>
                      <br>
                      <small class="text-muted"><?= esc($spot['location']) ?></small>
                    </label>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
            <small class="text-muted d-block mt-2">You can select as many tourist spots as you want. All registered spots are available.</small>
          </div>

          <div class="d-grid gap-2">
            <button class="btn btn-success btn-lg">
              <i class="fa fa-save me-1"></i> Save Package
            </button>
            <a href="<?= base_url('packages') ?>" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>