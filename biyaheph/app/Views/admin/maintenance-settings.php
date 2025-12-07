
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  .maintenance-hero {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    padding: 2.5rem 0;
    margin-bottom: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.3);
  }

  .maintenance-hero h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .maintenance-hero p {
    opacity: 0.95;
    margin: 0;
  }

  .maintenance-card {
    background: white;
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    overflow: hidden;
  }

  .maintenance-card-header {
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #d1d5db;
  }

  .maintenance-card-header h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 700;
    color: #1f2937;
  }

  .maintenance-card-body {
    padding: 2rem;
  }

  .toggle-switch {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #fef3c7 0%, #fef9e7 100%);
    border-radius: 10px;
    border-left: 4px solid #f59e0b;
    margin-bottom: 2rem;
  }

  .toggle-switch-label {
    flex: 1;
  }

  .toggle-switch-label h5 {
    margin: 0 0 0.3rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: #78350f;
  }

  .toggle-switch-label p {
    margin: 0;
    font-size: 0.85rem;
    color: #b45309;
  }

  .form-check-input {
    width: 50px;
    height: 28px;
    border: 2px solid #d1d5db;
    border-radius: 20px;
    cursor: pointer;
    position: relative;
  }

  .form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-label {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .form-label i {
    color: #f59e0b;
  }

  .form-control {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    font-family: monospace;
  }

  .form-control:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    outline: none;
  }

  .textarea-helper {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
    font-size: 0.85rem;
    color: #6b7280;
  }

  .textarea-helper button {
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.8rem;
    transition: all 0.3s ease;
  }

  .textarea-helper button:hover {
    background: #e5e7eb;
  }

  .info-box {
    background: #dbeafe;
    border-left: 4px solid #0066cc;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    color: #1e40af;
  }

  .info-box i {
    margin-right: 0.5rem;
  }

  .info-box strong {
    display: block;
    margin-bottom: 0.3rem;
  }

  .info-box p {
    margin: 0;
    font-size: 0.9rem;
    word-break: break-all;
  }

  .ip-list {
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 0.75rem;
  }

  .ip-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    font-size: 0.9rem;
  }

  .ip-item:not(:last-child) {
    border-bottom: 1px solid #d1d5db;
  }

  .ip-badge {
    background: linear-gradient(135deg, #0066cc 0%, #00a8e8 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
  }

  .ip-badge.current {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  }

  .btn-update {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.875rem 2rem;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    color: white;
  }

  .section-divider {
    margin: 2rem 0;
    padding-top: 2rem;
    border-top: 2px solid #e5e7eb;
  }
</style>

<!-- Header -->
<div class="maintenance-hero">
  <div class="container">
    <h1><i class="fas fa-tools me-2"></i>Maintenance Mode Settings</h1>
    <p>Control system availability and manage admin access during maintenance</p>
  </div>
</div>

<!-- Main Content -->
<div class="container">
  <!-- Success/Error Alerts -->
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

  <?php if ($settings): ?>
  <div class="row">
    <div class="col-lg-8">
      <div class="maintenance-card">
        <div class="maintenance-card-header">
          <h3><i class="fas fa-sliders-h me-2"></i>Maintenance Configuration</h3>
        </div>

        <div class="maintenance-card-body">
          <form method="post" action="<?= site_url('settings/maintenance') ?>">
            <?= csrf_field() ?>

            <!-- Maintenance Mode Toggle -->
            <div class="toggle-switch">
              <div class="toggle-switch-label">
                <h5><i class="fas fa-power-off me-1"></i>Maintenance Mode</h5>
                <p>Enable to restrict tourist access. Admins with approved IPs can still access.</p>
              </div>
              <div class="form-check form-switch">
                <input 
                  class="form-check-input" 
                  type="checkbox" 
                  id="maintenanceMode" 
                  name="maintenance_mode"
                  value="1"
                  <?= (isset($settings['maintenance_mode']) && $settings['maintenance_mode']) ? 'checked' : '' ?>
                  style="width: 50px; height: 28px;">
              </div>
            </div>

            <!-- Maintenance Message -->
            <div class="form-group">
              <label class="form-label" for="maintenanceMessage">
                <i class="fas fa-message"></i>Maintenance Message
              </label>
              <textarea 
                id="maintenanceMessage"
                name="maintenance_message" 
                class="form-control" 
                rows="4"
                placeholder="Enter message to display to users during maintenance..."><?= isset($settings['maintenance_message']) ? esc($settings['maintenance_message']) : 'We are currently under maintenance. Please check back soon!' ?></textarea>
              <div class="textarea-helper">
                <button type="button" onclick="insertTemplate('default')">Default Message</button>
                <button type="button" onclick="insertTemplate('estimated')">With Estimate</button>
              </div>
            </div>

            <!-- Admin IPs Section -->
            <div class="section-divider">
              <h5 class="mb-3"><i class="fas fa-shield me-2"></i>Admin IP Whitelist</h5>
              <p class="text-muted mb-3">Enter IP addresses that can access the system during maintenance</p>
            </div>

            <div class="info-box">
              <strong><i class="fas fa-info-circle"></i>Your Current IP</strong>
              <p><?= esc($currentIp) ?></p>
            </div>

            <div class="form-group">
              <label class="form-label" for="adminIps">
                <i class="fas fa-list"></i>Allowed Admin IPs
              </label>
              <textarea 
                id="adminIps"
                name="admin_ips" 
                class="form-control" 
                rows="5"
                placeholder="192.168.1.1&#10;192.168.1.2&#10;10.0.0.5"><?= isset($settings['admin_ips']) ? esc($settings['admin_ips']) : '' ?></textarea>
              <small class="text-muted d-block mt-2">
                <i class="fas fa-lightbulb"></i>
                One IP address per line or separated by commas. Leave empty to allow all admins.
              </small>
            </div>

            <!-- Submit Button -->
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-update">
                <i class="fas fa-save me-2"></i>Save Settings
              </button>
              <button type="reset" class="btn btn-outline-secondary">
                <i class="fas fa-redo me-2"></i>Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
      <!-- Status Card -->
      <div class="maintenance-card mb-4">
        <div class="maintenance-card-header">
          <h5 class="mb-0"><i class="fas fa-signal me-2"></i>Current Status</h5>
        </div>
        <div class="maintenance-card-body text-center">
          <div style="font-size: 2.5rem; margin-bottom: 1rem;">
            <?php if (isset($settings['maintenance_mode']) && $settings['maintenance_mode']): ?>
              <i class="fas fa-exclamation-triangle" style="color: #f59e0b;"></i>
            <?php else: ?>
              <i class="fas fa-check-circle" style="color: #10b981;"></i>
            <?php endif; ?>
          </div>
          <h6>
            <?php if (isset($settings['maintenance_mode']) && $settings['maintenance_mode']): ?>
              <span class="badge bg-warning" style="padding: 0.5rem 1rem;">UNDER MAINTENANCE</span>
            <?php else: ?>
              <span class="badge bg-success" style="padding: 0.5rem 1rem;">SYSTEM OPERATIONAL</span>
            <?php endif; ?>
          </h6>
        </div>
      </div>

      <!-- Quick Toggle Card -->
      <div class="maintenance-card mb-4">
        <div class="maintenance-card-header">
          <h5 class="mb-0"><i class="fas fa-toggle-on me-2"></i>Quick Toggle</h5>
        </div>
        <div class="maintenance-card-body">
          <form method="post" action="<?= site_url('settings/toggle-maintenance') ?>">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-warning w-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; color: white; padding: 0.75rem;">
              <i class="fas fa-power-off me-2"></i>
              <?php if (isset($settings['maintenance_mode']) && $settings['maintenance_mode']): ?>
                Disable Maintenance
              <?php else: ?>
                Enable Maintenance
              <?php endif; ?>
            </button>
          </form>
        </div>
      </div>

      <!-- Help Card -->
      <div class="maintenance-card">
        <div class="maintenance-card-header">
          <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>How It Works</h5>
        </div>
        <div class="maintenance-card-body" style="font-size: 0.9rem;">
          <ul style="margin-bottom: 0; padding-left: 1.25rem;">
            <li class="mb-2"><strong>Enabled:</strong> Tourists cannot access; admins automatically bypass</li>
            <li class="mb-2"><strong>Disabled:</strong> All users can access normally</li>
            <li class="mb-2"><strong>IP Whitelist:</strong> Optional; additional IP restrictions</li>
            <li><strong>Logged-in Admins:</strong> Always bypass maintenance mode</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
    <div class="alert alert-warning">
      <i class="fas fa-exclamation-triangle me-2"></i>
      Unable to load maintenance settings. Please try refreshing the page.
    </div>
  <?php endif; ?>
</div>

<!-- Maintenance Page -->
<script>
function insertTemplate(type) {
  const textarea = document.getElementById('maintenanceMessage');
  let message = '';

  if (type === 'default') {
    message = 'We are currently under maintenance. Please check back soon!';
  } else if (type === 'estimated') {
    message = 'We are currently under scheduled maintenance. We expect to be back online shortly. Thank you for your patience!';
  }

  textarea.value = message;
}
</script>

<?= $this->endSection() ?>