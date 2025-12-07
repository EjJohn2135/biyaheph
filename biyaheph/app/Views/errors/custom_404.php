
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5 text-center">
  <h1>404 — Page not found</h1>
  <p>The page you requested could not be found.</p>
  <a href="<?= base_url() ?>" class="btn btn-primary">Return to home</a>
</div>

<?= $this->endSection() ?>