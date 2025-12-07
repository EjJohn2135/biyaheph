
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Tour Packages (Admin)</h2>
  <a class="btn btn-success" href="<?= base_url('packages/create') ?>"><i class="fa fa-plus me-1"></i> Add New</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table class="table table-striped table-hover">
  <thead>
    <tr><th>Image</th><th>Title</th><th>Price</th><th>Actions</th></tr>
  </thead>
  <tbody>
  <?php foreach ($packages as $p): ?>
    <tr>
      <td style="width:120px;">
        <?php if (!empty($p['image'])): ?>
          <img src="<?= base_url('writable/uploads/'.$p['image']) ?>" class="img-thumbnail" style="height:70px;object-fit:cover;">
        <?php endif; ?>
      </td>
      <td><?= esc($p['title']) ?></td>
      <td>₱<?= esc(number_format($p['price'],2)) ?></td>
      <td>
        <a href="<?= base_url('packages/edit/'.$p['id']) ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
        <a href="<?= base_url('packages/delete/'.$p['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this package?')"><i class="fa fa-trash"></i> Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>