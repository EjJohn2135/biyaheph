<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
function getPlaceholderSvg($text = 'Image') {
    return 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect fill=%22%23d1fae5%22 width=%22400%22 height=%22300%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2224%22 fill=%22%23059669%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-family=%22Arial%22%3E' . urlencode($text) . '%3C/text%3E%3C/svg%3E';
}
?>

<style>
  .agency-card {
    border: none;
    border-radius: 1.2rem;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
  }

  .agency-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(16,185,129,0.2);
  }

  .agency-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    display: block;
  }

  .agency-card-body {
    padding: 1.5rem;
  }

  .agency-card-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
  }

  .agency-card-info {
    font-size: 0.85rem;
    color: #64748b;
    margin-bottom: 0.5rem;
  }

  .agency-card-contact {
    font-size: 0.85rem;
    color: #10b981;
    margin-bottom: 0.5rem;
  }

  .agency-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
  }

  .agency-actions .btn {
    flex: 1;
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
  }

  .empty-state {
    text-align: center;
    padding: 3rem;
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    border-radius: 1rem;
    border: 2px dashed #10b981;
  }

  .grid-view {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
  }

  @media (max-width: 768px) {
    .grid-view {
      grid-template-columns: 1fr;
    }
    .agency-card-img {
      height: 180px;
    }
  }
</style>

<div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 2rem; border-radius: 1rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
  <div>
    <h2 class="mb-1"><i class="fas fa-briefcase me-2"></i>Tour Agencies</h2>
    <p class="mb-0">Manage tour agencies and partners</p>
  </div>
  <a href="<?= base_url('touragencies/create') ?>" class="btn btn-light btn-lg text-success fw-bold">
    <i class="fas fa-plus me-1"></i> Add Tour Agency
  </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<?php if (!empty($agencies)): ?>
  <div class="grid-view">
    <?php foreach($agencies as $agency): ?>
      <div class="agency-card">
        <!-- Image -->
        <?php
          $photoPath = !empty($agency['photo']) ? 'writable/uploads/' . $agency['photo'] : '';
          $fileExists = !empty($photoPath) && file_exists(WRITEPATH . 'uploads/' . $agency['photo']);
        ?>
        
        <?php if ($fileExists): ?>
          <img src="<?= base_url($photoPath) ?>" 
               class="agency-card-img" 
               alt="<?= esc($agency['name']) ?>"
               onerror="this.src='<?= getPlaceholderSvg('No Photo') ?>'">
        <?php else: ?>
          <img src="<?= getPlaceholderSvg('Tour Agency') ?>" 
               class="agency-card-img" 
               alt="<?= esc($agency['name']) ?>">
        <?php endif; ?>
        
        <div class="agency-card-body">
          <div class="agency-card-name">
            <i class="fas fa-briefcase me-2" style="color:#10b981;"></i><?= esc($agency['name']) ?>
          </div>
          
          <div class="agency-card-info">
            <i class="fas fa-location-dot me-1"></i><?= esc($agency['address'] ?? 'N/A') ?>
          </div>
          
          <?php if (!empty($agency['contact'])): ?>
            <div class="agency-card-contact">
              <i class="fas fa-phone me-1"></i><?= esc($agency['contact']) ?>
            </div>
          <?php endif; ?>
          
          <?php if (!empty($agency['email'])): ?>
            <div class="agency-card-contact">
              <i class="fas fa-envelope me-1"></i><?= esc($agency['email']) ?>
            </div>
          <?php endif; ?>
          
          <small class="text-muted d-block">
            <i class="far fa-calendar me-1"></i><?= date('M d, Y', strtotime($agency['created_at'])) ?>
          </small>
          
          <div class="agency-actions">
            <a href="<?= base_url('touragencies/edit/'.$agency['id']) ?>" class="btn btn-warning btn-sm">
              <i class="fas fa-edit me-1"></i>Edit
            </a>
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem('<?= $agency['id'] ?>', 'touragencies', '<?= esc($agency['name']) ?>')">
              <i class="fas fa-trash me-1"></i>Delete
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <div class="empty-state">
    <i class="fas fa-building" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;"></i>
    <h5 class="text-success">No Tour Agencies Yet</h5>
    <p class="text-muted">Start by adding your first tour agency</p>
    <a href="<?= base_url('touragencies/create') ?>" class="btn btn-success mt-3">
      <i class="fas fa-plus me-1"></i> Add Tour Agency
    </a>
  </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const baseUrl = '<?= base_url() ?>';

function deleteItem(id, type, name) {
  Swal.fire({
    title: 'Delete ' + type + '?',
    text: `Are you sure you want to delete "${name}"? This action cannot be undone.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, Delete',
    cancelButtonText: 'Cancel',
    background: '#fff'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = baseUrl + type + '/delete/' + id;
    }
  });
}
</script>

<?= $this->endSection() ?>