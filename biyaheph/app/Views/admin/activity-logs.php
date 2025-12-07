
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  .activity-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 10px;
    margin-bottom: 2rem;
  }

  .activity-header h3 {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 700;
  }

  .table-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    overflow: hidden;
  }

  .table thead {
    background: #f8fafc;
    border-bottom: 2px solid #e5e7eb;
  }

  .table thead th {
    font-weight: 600;
    color: #1f2937;
    padding: 1rem;
  }

  .table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-color: #f3f4f6;
  }

  .table tbody tr:hover {
    background: #f9fafb;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
  }

  .user-details {
    flex: 1;
  }

  .user-name {
    font-weight: 600;
    color: #1f2937;
    margin: 0;
    font-size: 0.95rem;
  }

  .user-id {
    font-size: 0.8rem;
    color: #6b7280;
    margin: 0;
  }

  .badge-role {
    display: inline-block;
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
    font-weight: 600;
    border-radius: 20px;
    margin-top: 0.25rem;
  }

  .badge-admin {
    background: #fee2e2;
    color: #991b1b;
  }

  .badge-tourist {
    background: #dbeafe;
    color: #1e40af;
  }

  .action-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.35rem;
    white-space: nowrap;
  }

  /* Action Colors */
  .action-auth {
    background: #dbeafe;
    color: #1e40af;
  }

  .action-create {
    background: #d1fae5;
    color: #065f46;
  }

  .action-edit {
    background: #fef3c7;
    color: #78350f;
  }

  .action-delete {
    background: #fee2e2;
    color: #991b1b;
  }

  .action-approve {
    background: #d1fae5;
    color: #065f46;
  }

  .action-reject {
    background: #fee2e2;
    color: #991b1b;
  }

  .action-view {
    background: #f3e8ff;
    color: #6b21a8;
  }

  .action-description {
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.5rem;
    padding: 0.5rem;
    background: #f9fafb;
    border-radius: 4px;
    border-left: 3px solid #667eea;
  }

  .action-description i {
    color: #667eea;
    margin-right: 0.35rem;
  }

  .timestamp {
    font-size: 0.85rem;
    color: #6b7280;
  }

  .ip-badge {
    background: #f3f4f6;
    color: #374151;
    padding: 0.35rem 0.6rem;
    border-radius: 20px;
    font-family: monospace;
    font-size: 0.8rem;
    display: inline-block;
  }

  .mac-badge {
    background: #fef3c7;
    color: #78350f;
    padding: 0.35rem 0.6rem;
    border-radius: 20px;
    font-family: monospace;
    font-size: 0.8rem;
    display: inline-block;
  }

  .btn-view-details {
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
    border-radius: 5px;
    transition: all 0.3s ease;
  }

  .btn-view-details:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .search-box {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }

  .status-badge {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
  }

  .status-success {
    background: #d1fae5;
    color: #065f46;
  }

  .status-failed {
    background: #fee2e2;
    color: #991b1b;
  }

  /* Pagination Styling */
  .pagination {
    margin-top: 2rem;
    justify-content: center;
  }

  .pagination .page-link {
    border-radius: 0.5rem;
    margin: 0 0.25rem;
    border-color: #e5e7eb;
    color: #667eea;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .pagination .page-link:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
    transform: translateY(-2px);
  }

  .pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
  }

  .pagination .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
  }

  /* Record count info */
  .records-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: #f3f4f6;
    border-radius: 0.6rem;
    font-size: 0.95rem;
  }

  .records-info strong {
    color: #667eea;
  }
</style>

<!-- Header -->
<div class="activity-header">
  <div>
    <h3><i class="fas fa-history me-2"></i>Activity Logs</h3>
    <p class="mb-0 opacity-75">Monitor all user activities, account changes, and system events</p>
  </div>
</div>

<!-- Search -->
<div class="mb-4">
  <form class="search-box" method="get" action="<?= site_url('admin/activity-logs') ?>">
    <input type="search" name="q" class="form-control" placeholder="Search user name, activity type, IP address..." value="<?= esc($q ?? '') ?>" style="max-width: 450px;">
    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
    <?php if (!empty($q)): ?>
      <a href="<?= site_url('admin/activity-logs') ?>" class="btn btn-secondary"><i class="fas fa-times"></i> Clear</a>
    <?php endif; ?>
  </form>
</div>

<!-- Records Info -->
<?php if (!empty($logs)): ?>
  <div class="records-info">
    <span><strong><?= count($logs) ?></strong> records shown on this page</span>
    <span class="text-muted">Page <strong><?= $pager->getCurrentPage() ?></strong> of <strong><?= $pager->getPageCount() ?></strong></span>
  </div>
<?php endif; ?>

<!-- Table -->
<div class="table-container">
  <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th style="width: 6%">#</th>
          <th style="width: 10%">Date & Time</th>
          <th style="width: 18%">User Name</th>
          <th style="width: 28%">Activity</th>
          <th style="width: 12%">IP Address</th>
          <th style="width: 12%">MAC Address</th>
          <th style="width: 14%">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($logs)): foreach ($logs as $log): ?>
          <tr>
            <!-- ID -->
            <td>
              <strong>#<?= esc($log['id']) ?></strong>
            </td>

            <!-- Timestamp -->
            <td>
              <span class="timestamp d-block"><?= date('M d, Y', strtotime($log['created_at'])) ?></span>
              <span class="timestamp d-block"><i class="fas fa-clock me-1"></i><?= date('H:i:s', strtotime($log['created_at'])) ?></span>
            </td>

            <!-- User Name (Full Name) -->
            <td>
              <div class="user-info">
                <div class="user-avatar">
                  <?= strtoupper(substr($log['name'] ?? 'U', 0, 1)) ?>
                </div>
                <div class="user-details">
                  <p class="user-name"><?= esc($log['name'] ?? 'Anonymous') ?></p>
                  <p class="user-id">ID: <?= esc($log['user_id'] ?? '—') ?></p>
                  <?php if ($log['role'] ?? null): ?>
                    <span class="badge-role <?= ($log['role'] ?? '') === 'admin' ? 'badge-admin' : 'badge-tourist' ?>">
                      <?= ucfirst($log['role'] ?? '') ?>
                    </span>
                  <?php endif; ?>
                </div>
              </div>
            </td>

            <!-- Activity (Human-Readable) - IMPROVED -->
            <td>
              <?php
              helper('activity_format');
              $fmt = activity_format($log['action'] ?? '', $log['details'] ?? null);
              $label = $fmt['label'] ?? ucwords(str_replace('_', ' ', $log['action'] ?? 'Action'));
              $icon = $fmt['icon'] ?? 'fa-circle-info';
              $class = $fmt['class'] ?? 'action-view';
              $desc = $fmt['description'] ?? '';
              ?>
              <span class="action-badge <?= esc($class) ?>">
                <i class="fas <?= esc($icon) ?>" style="font-size: 0.95rem;"></i>
                <span><?= esc($label) ?></span>
              </span>
              <div class="action-description">
                <i class="fas fa-arrow-right"></i><?= esc($desc) ?>
              </div>
            </td>

            <!-- IP Address -->
            <td>
              <span class="ip-badge">
                <i class="fas fa-globe me-1"></i><?= esc($log['ip_address'] ?? '—') ?>
              </span>
            </td>

            <!-- MAC Address -->
            <td>
              <?php if ($log['mac_address'] && $log['mac_address'] !== 'N/A'): ?>
                <span class="mac-badge">
                  <i class="fas fa-network-wired me-1"></i><?= esc($log['mac_address']) ?>
                </span>
              <?php else: ?>
                <span class="text-muted"><i class="fas fa-ban me-1"></i>N/A</span>
              <?php endif; ?>
            </td>

            <!-- View Details Button -->
            <td>
              <button type="button" class="btn btn-sm btn-outline-info btn-view-details" 
                data-details='<?= json_encode($log['details'], JSON_HEX_APOS|JSON_HEX_QUOT) ?>'
                data-name="<?= esc($log['name']) ?>"
                data-action="<?= esc($log['action']) ?>"
                data-ip="<?= esc($log['ip_address']) ?>"
                data-mac="<?= esc($log['mac_address']) ?>"
                data-timestamp="<?= esc($log['created_at']) ?>"
                title="View full details">
                <i class="fas fa-eye"></i> View
              </button>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="7" class="text-center p-4">
              <i class="fas fa-inbox" style="font-size: 2rem; color: #d1d5db;"></i>
              <p class="text-muted mt-2">No activity logs found.</p>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Pagination -->
<?php if (!empty($logs) && isset($pager)): ?>
  <nav aria-label="Activity logs pagination" class="mt-4">
    <ul class="pagination justify-content-center">
      <?php 
        $currentPage = $pager->getCurrentPage();
        $totalPages = $pager->getPageCount();
      ?>

      <!-- First & Previous -->
      <?php if ($currentPage > 1): ?>
        <li class="page-item">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=1' . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>" aria-label="First">
            <i class="fas fa-chevron-double-left"></i> First
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=' . ($currentPage - 1) . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>" aria-label="Previous">
            <i class="fas fa-chevron-left"></i> Previous
          </a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link"><i class="fas fa-chevron-double-left"></i> First</span>
        </li>
        <li class="page-item disabled">
          <span class="page-link"><i class="fas fa-chevron-left"></i> Previous</span>
        </li>
      <?php endif; ?>

      <!-- Page Numbers -->
      <?php 
        $start = max(1, $currentPage - 2);
        $end = min($totalPages, $currentPage + 2);
      ?>

      <?php if ($start > 1): ?>
        <li class="page-item">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=1' . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>">1</a>
        </li>
        <?php if ($start > 2): ?>
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
        <?php endif; ?>
      <?php endif; ?>

      <?php for ($i = $start; $i <= $end; $i++): ?>
        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=' . $i . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>">
            <?= $i ?>
          </a>
        </li>
      <?php endfor; ?>

      <?php if ($end < $totalPages): ?>
        <?php if ($end < $totalPages - 1): ?>
          <li class="page-item disabled">
            <span class="page-link">...</span>
          </li>
        <?php endif; ?>
        <li class="page-item">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=' . $totalPages . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>">
            <?= $totalPages ?>
          </a>
        </li>
      <?php endif; ?>

      <!-- Next & Last -->
      <?php if ($currentPage < $totalPages): ?>
        <li class="page-item">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=' . ($currentPage + 1) . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>" aria-label="Next">
            Next <i class="fas fa-chevron-right"></i>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="<?= base_url('admin/activity-logs?page=' . $totalPages . (!empty($q) ? '&q=' . urlencode($q) : '')) ?>" aria-label="Last">
            Last <i class="fas fa-chevron-double-right"></i>
          </a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link">Next <i class="fas fa-chevron-right"></i></span>
        </li>
        <li class="page-item disabled">
          <span class="page-link">Last <i class="fas fa-chevron-double-right"></i></span>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
<?php endif; ?>

<!-- Details Modal -->
<div class="modal fade" id="logDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <div class="w-100">
          <h5 class="modal-title mb-2"><i class="fas fa-info-circle me-2"></i>Activity Details</h5>
          <small class="text-muted" id="logUserInfo"></small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- User Info Card -->
        <div class="card mb-3 border-0 bg-light">
          <div class="card-body">
            <h6 class="card-title text-muted mb-2">User Information</h6>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-2"><strong>Name:</strong></p>
                <p id="logUserName" class="text-primary fw-bold"></p>
              </div>
              <div class="col-md-6">
                <p class="mb-2"><strong>Timestamp:</strong></p>
                <p id="logTimestamp" class="text-secondary"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Activity Info Card -->
        <div class="card mb-3 border-0 bg-light">
          <div class="card-body">
            <h6 class="card-title text-muted mb-2">Activity Information</h6>
            <p class="mb-2"><strong>Action:</strong></p>
            <p id="logActionName" class="mb-3 fw-bold"></p>
          </div>
        </div>

        <!-- Network Info Card -->
        <div class="card mb-3 border-0 bg-light">
          <div class="card-body">
            <h6 class="card-title text-muted mb-2">Network Information</h6>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-2"><strong>IP Address:</strong></p>
                <p id="logIP" class="font-monospace text-secondary"></p>
              </div>
              <div class="col-md-6">
                <p class="mb-2"><strong>MAC Address:</strong></p>
                <p id="logMAC" class="font-monospace text-secondary"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Request Details Card -->
        <div class="card border-0 bg-light">
          <div class="card-body">
            <h6 class="card-title text-muted mb-2">Request Details</h6>
            <pre id="logDetailsPre" style="white-space:pre-wrap;background:#f8fafc;padding:1rem;border-radius:.5rem;border:1px solid #e5e7eb;max-height: 400px; overflow-y: auto; font-size: 0.85rem;"></pre>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('click', function(e) {
  const btn = e.target.closest('.btn-view-details');
  if (!btn) return;
  
  const raw = btn.getAttribute('data-details') || '{}';
  const name = btn.getAttribute('data-name') || 'Unknown';
  const action = btn.getAttribute('data-action') || 'Unknown Action';
  const ip = btn.getAttribute('data-ip') || '—';
  const mac = btn.getAttribute('data-mac') || 'N/A';
  const timestamp = btn.getAttribute('data-timestamp') || '—';
  
  let pretty = raw;
  try {
    const parsed = JSON.parse(raw);
    pretty = JSON.stringify(parsed, null, 2);
  } catch (err) {
    pretty = raw;
  }
  
  document.getElementById('logUserName').textContent = name;
  document.getElementById('logActionName').textContent = action;
  document.getElementById('logUserInfo').textContent = 'Complete activity log details';
  document.getElementById('logIP').textContent = ip;
  document.getElementById('logMAC').textContent = mac;
  document.getElementById('logTimestamp').textContent = timestamp;
  document.getElementById('logDetailsPre').textContent = pretty;
  
  new bootstrap.Modal(document.getElementById('logDetailsModal')).show();
});
</script>

<?= $this->endSection() ?>