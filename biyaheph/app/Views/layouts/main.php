
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>BiyahePH - Explore Philippines</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    /* ...existing styles... (kept from original) */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background-color: #f8fafc; color: #334155; }

    /* Navbar Styling */
    .navbar {
      background: linear-gradient(135deg, #0066cc 0%, #00a8e8 100%) !important;
      padding: 1rem 0 !important;
      box-shadow: 0 2px 10px rgba(0, 102, 204, 0.15);
      backdrop-filter: blur(10px);
    }
    .navbar-brand { font-family: 'Poppins', sans-serif; font-size: 1.5rem !important; font-weight: 700 !important; letter-spacing: -0.5px; background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .navbar .nav-link { color: rgba(255,255,255,0.9) !important; font-weight:500; margin:0 0.5rem; padding:0.5rem 1rem !important; border-radius:0.5rem; transition:all .3s ease; position:relative; }
    .navbar .nav-link:hover { color:#fff !important; background: rgba(255,255,255,0.1); transform: translateY(-2px); }
    .navbar .nav-link::after { content:''; position:absolute; bottom:0; left:0; width:0; height:2px; background:#ffffff; transition: width .3s ease; }
    .navbar .nav-link:hover::after { width:100%; }

    /* Sidebar Styling */
    .sidebar { min-height:100vh; background: linear-gradient(180deg, #0066cc 0%, #0052a3 100%); color:#fff; padding:2rem 1rem !important; position:sticky; top:0; box-shadow:2px 0 20px rgba(0,102,204,0.2); overflow-y:auto; }
    .sidebar .nav-link { color: rgba(255,255,255,0.85); padding:0.75rem 1rem !important; border-radius:0.6rem; margin-bottom:0.5rem; transition: all 0.3s; border-left:3px solid transparent; display:flex; align-items:center; position:relative; overflow:hidden; }
    .sidebar .nav-link:hover { color:#fff; background: rgba(255,255,255,0.15); border-left-color:#00d4ff; transform: translateX(4px); }
    .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color:#fff; border-left-color:#00d4ff; }
    .sidebar-title { font-family:'Poppins',sans-serif; font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color: rgba(255,255,255,0.5); padding:1.5rem 1rem 0.75rem; margin-top:1.5rem; border-top:1px solid rgba(255,255,255,0.1); }
    .sidebar .collapse .nav-link { padding-left:2rem !important; font-size:0.95rem; }

    /* Notifications */
    .notif-badge {
      position: absolute;
      top: -6px;
      right: -6px;
      font-size: .65rem;
      padding: 2px 6px;
      border-radius: 999px;
      background: #ef4444;
      color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.12);
      display: none;
    }
    .notif-dropdown { min-width: 320px; max-height: 420px; overflow: auto; }

    /* Responsive Sidebar for small screens */
    @media (max-width: 991.98px) {
      .sidebar { position: fixed; left: -280px; width: 280px; height:100vh; z-index:1050; transition:left .28s ease; }
      .sidebar.show { left: 0; }
      main.content { padding-top: 1rem; }
    }

    /* keep rest of original styles intact */
    /* ...existing code... */
  </style>
</head>

<body>
  <!-- Top Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <div class="d-flex align-items-center gap-2">
        <!-- Sidebar Toggle (burger) visible on small screens -->
        <button class="btn btn-light d-lg-none me-2" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
          <i class="fas fa-bars"></i>
        </button>

        <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
          <i class="fas fa-compass me-2"></i>BiyahePH
        </a>
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <?php if (session()->get('logged_in')): ?>
            <!-- Notifications dropdown -->
            <li class="nav-item dropdown me-2 position-relative">
              <a class="nav-link position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell fa-lg"></i>
                <span id="notifCountBadge" class="notif-badge">0</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end notif-dropdown p-2" aria-labelledby="notifDropdown" id="notifMenu">
                <li class="d-flex justify-content-between align-items-center px-2">
                  <small class="text-muted">Notifications</small>
                  <small><a href="#" id="markAllReadLink" class="small">Mark all read</a></small>
                </li>
                <li><hr class="dropdown-divider"></li>
                <div id="notifItems">
                  <li class="dropdown-item text-center text-muted small">Loading...</li>
                </div>
                <li><hr class="dropdown-divider"></li>
                <li class="px-2"><a href="<?= base_url('admin/activity-logs') ?>" class="small">View all activity logs</a></li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('dashboard') ?>">
                <i class="fas fa-home me-1"></i>Dashboard
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/login') ?>">
                <i class="fas fa-sign-in-alt me-1"></i>Login
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/register') ?>">
                <i class="fas fa-user-plus me-1"></i>Register
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Container -->
  <div class="container-fluid">
    <div class="row g-0">
      <!-- Sidebar -->
      <aside class="col-lg-2 d-none d-lg-block sidebar" id="mainSidebar">
        <ul class="nav flex-column">
          <?php if (session()->get('logged_in')): ?>
            <li class="mb-2">
              <a class="nav-link" href="<?= base_url('dashboard') ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="mb-2">
              <a class="nav-link" href="<?= base_url('packages') ?>">
                <i class="fas fa-boxes-stacked"></i>
                <span>Packages</span>
              </a>
            </li>

            <?php if (session()->get('role') === 'admin'): ?>
              <li class="mb-2">
                <a class="nav-link" href="<?= base_url('settings/maintenance') ?>">
                  <i class="fas fa-tools"></i>
                  <span>Maintenance Mode</span>
                </a>
              </li>
              <li class="mb-2">
                <a class="nav-link" href="<?= base_url('admin/activity-logs') ?>">
                  <i class="fas fa-list"></i>
                  <span>Activity Logs</span>
                </a>
              </li>

<li class="mb-2">
  <a class="nav-link" href="<?= base_url('admin/bugs') ?>">
    <i class="fas fa-bug"></i>
    <span>Bug Logs</span>
  </a>
</li>
              <div class="sidebar-title">Management</div>

              <li class="mb-2">
                <a class="nav-link" href="<?= base_url('packages/create') ?>">
                  <i class="fas fa-plus-circle"></i>
                  <span>Add Package</span>
                </a>
              </li>
              <li class="mb-2">
                <a class="nav-link" href="<?= base_url('bookings/manage') ?>">
                  <i class="fas fa-calendar-check"></i>
                  <span>Manage Bookings</span>
                </a>
              </li>

              <div class="sidebar-title">Configuration</div>

              <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" href="#setupMenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="setupMenu">
                  <span>
                    <i class="fas fa-cog"></i>
                    <span>Setup</span>
                  </span>
                  <i class="fas fa-chevron-down" id="setupToggleIcon"></i>
                </a>
                <div class="collapse" id="setupMenu">
                  <ul class="nav flex-column ps-3 mt-2">
                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('accommodations') ?>">
                        <i class="fas fa-hotel"></i>
                        <span>Accommodations</span>
                      </a>
                    </li>
                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('accommodations/create') ?>">
                        <i class="fas fa-plus"></i>
                        <span>Add Accommodation</span>
                      </a>
                    </li>

                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('touristspots') ?>">
                        <i class="fas fa-map-pin"></i>
                        <span>Tourist Spots</span>
                      </a>
                    </li>
                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('touristspots/create') ?>">
                        <i class="fas fa-plus"></i>
                        <span>Add Tourist Spot</span>
                      </a>
                    </li>

                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('touragencies') ?>">
                        <i class="fas fa-briefcase"></i>
                        <span>Tour Agencies</span>
                      </a>
                    </li>
                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('touragencies/create') ?>">
                        <i class="fas fa-plus"></i>
                        <span>Add Tour Agency</span>
                      </a>
                    </li>

                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('tourguides') ?>">
                        <i class="fas fa-user-tie"></i>
                        <span>Tour Guides</span>
                      </a>
                    </li>
                    <li class="mb-2">
                      <a class="nav-link" href="<?= base_url('tourguides/create') ?>">
                        <i class="fas fa-plus"></i>
                        <span>Add Tour Guide</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <?php else: ?>
              <div class="sidebar-title">Activities</div>
              <li class="mb-2">
                <a class="nav-link" href="<?= base_url('bookings/my-bookings') ?>">
                  <i class="fas fa-ticket-alt"></i>
                  <span>My Bookings</span>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </aside>

      <!-- Sidebar for small devices (offcanvas-like) -->
      <aside class="sidebar d-lg-none" id="mobileSidebar" aria-hidden="true" style="left:-280px;">
        <div class="p-3">
          <button class="btn btn-light mb-3" id="mobileSidebarClose"><i class="fas fa-times"></i></button>
          <ul class="nav flex-column">
            <?php if (session()->get('logged_in')): ?>
              <li class="mb-2"><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
              <li class="mb-2"><a class="nav-link" href="<?= base_url('packages') ?>"><i class="fas fa-boxes-stacked"></i> Packages</a></li>
              <?php if (session()->get('role') === 'admin'): ?>
                <li class="mb-2"><a class="nav-link" href="<?= base_url('admin/activity-logs') ?>"><i class="fas fa-list"></i> Activity Logs</a></li>
                <li class="mb-2"><a class="nav-link" href="<?= base_url('bookings/manage') ?>"><i class="fas fa-calendar-check"></i> Manage Bookings</a></li>
              <?php else: ?>
                <li class="mb-2"><a class="nav-link" href="<?= base_url('bookings/my-bookings') ?>"><i class="fas fa-ticket-alt"></i> My Bookings</a></li>
              <?php endif; ?>
            <?php endif; ?>
          </ul>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="col-lg-10 content">
        <div class="container-fluid">
          <!-- Flash messages -->
          <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
          <?php endif; ?>
          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
          <?php endif; ?>

          <?= $this->renderSection('content') ?>
        </div>
      </main>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    const BASE_URL = '<?= rtrim(base_url(), "/") ?>/';
    const SITE_URL = '<?= rtrim(site_url(), "/") ?>/';

    document.addEventListener('DOMContentLoaded', function() {
      // Setup Collapse Animation for setupMenu
      const setupToggle = document.getElementById('setupMenu');
      const setupIcon = document.getElementById('setupToggleIcon');
      if (setupToggle && setupIcon) {
        setupToggle.addEventListener('show.bs.collapse', function() { setupIcon.style.transform = 'rotate(180deg)'; });
        setupToggle.addEventListener('hide.bs.collapse', function() { setupIcon.style.transform = 'rotate(0deg)'; });
      }

      // Sidebar toggle (mobile)
      const sidebarToggleBtn = document.getElementById('sidebarToggle');
      const mobileSidebar = document.getElementById('mobileSidebar');
      const mobileSidebarClose = document.getElementById('mobileSidebarClose');
      const mainSidebar = document.getElementById('mainSidebar');

      if (sidebarToggleBtn && mobileSidebar) {
        sidebarToggleBtn.addEventListener('click', () => {
          mobileSidebar.style.left = '0';
          mobileSidebar.classList.add('show');
        });
      }
      if (mobileSidebarClose) {
        mobileSidebarClose.addEventListener('click', () => {
          mobileSidebar.style.left = '-280px';
          mobileSidebar.classList.remove('show');
        });
      }

      // Also allow toggling sidebar class on desktop (if needed)
      const desktopToggle = document.getElementById('sidebarToggleDesktop');
      if (desktopToggle && mainSidebar) {
        desktopToggle.addEventListener('click', () => {
          mainSidebar.classList.toggle('collapsed');
        });
      }

      // Flash messages with SweetAlert
      <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({ icon: 'success', title: 'Success!', text: '<?= esc(session()->getFlashdata('success')) ?>', timer: 3500, timerProgressBar: true, showConfirmButton: false, background: '#fff', didOpen: (toast) => { toast.style.borderLeft = '4px solid #10b981'; } });
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({ icon: 'error', title: 'Oops!', text: '<?= esc(session()->getFlashdata('error')) ?>', timer: 4000, timerProgressBar: true, showConfirmButton: false, background: '#fff', didOpen: (toast) => { toast.style.borderLeft = '4px solid #ef4444'; } });
      <?php endif; ?>

      // Notifications: fetch, render, mark read, clickable nav
      <?php if (session()->get('logged_in')): ?>
      const notifCountBadge = document.getElementById('notifCountBadge');
      const notifItems = document.getElementById('notifItems');
      const markAllReadLink = document.getElementById('markAllReadLink');

      async function fetchNotifications() {
        try {
          const res = await fetch('<?= site_url("notifications/fetch") ?>', { credentials: 'same-origin' });
          const data = await res.json();
          if (!data.success) return;
          const list = data.notifications || [];
          const unread = data.unread || 0;

          if (unread > 0) {
            notifCountBadge.style.display = 'inline-block';
            notifCountBadge.textContent = unread > 99 ? '99+' : unread;
          } else {
            notifCountBadge.style.display = 'none';
          }

          // build items
          notifItems.innerHTML = '';
          if (list.length === 0) {
            notifItems.innerHTML = '<li class="dropdown-item text-center text-muted small">No notifications</li>';
            return;
          }

          list.forEach(n => {
            const isUnread = (n.is_read == 0);
            const title = n.title ? n.title : (n.message ? n.message.substring(0,60) : 'Notification');
            const time = new Date(n.created_at).toLocaleString();

            const li = document.createElement('li');
            li.className = 'dropdown-item p-0 mb-1';
            // clickable anchor
            const a = document.createElement('a');
            a.href = n.url ? n.url : '#';
            a.className = 'd-flex text-decoration-none align-items-start p-2 ' + (isUnread ? 'bg-light' : '');
            a.setAttribute('data-id', n.id);
            a.setAttribute('data-url', n.url ? n.url : '');
            a.style.cursor = 'pointer';

            const left = document.createElement('div');
            left.className = 'flex-grow-1 me-2';
            left.innerHTML = `<div class="${isUnread ? 'fw-bold' : 'text-muted'}" style="max-width:220px;">${escapeHtml(title)}</div>
                              <small class="text-muted">${escapeHtml(n.message ? (n.message.length>80 ? n.message.substring(0,80)+'...' : n.message) : '')}</small>`;

            const right = document.createElement('div');
            right.className = 'text-end text-muted small';
            right.innerHTML = `<div style="white-space:nowrap;">${time}</div>
                               <button class="btn btn-sm btn-link text-primary mark-read-btn" data-id="${n.id}" style="font-size:.75rem;padding:0">Mark</button>`;

            a.appendChild(left);
            a.appendChild(right);
            li.appendChild(a);
            notifItems.appendChild(li);

            // click handler: mark read then navigate
            a.addEventListener('click', async function(e){
              e.preventDefault();
              const id = this.getAttribute('data-id');
              const url = this.getAttribute('data-url') || '';
              try {
                await markRead(id);
              } catch (err) { /* ignore */ }
              if (url) {
                window.location.href = url;
              } else {
                // fallback: refresh notifications dropdown
                await fetchNotifications();
              }
            });

            // mark button handler (keeps user on same menu)
            right.querySelector('.mark-read-btn').addEventListener('click', async function(ev){
              ev.preventDefault();
              ev.stopPropagation();
              const id = this.getAttribute('data-id');
              await markRead(id);
              await fetchNotifications();
            });
          });
        } catch (err) {
          // silently fail in UI
        }
      }

      async function markRead(id=null) {
        try {
          const payload = id ? {id: id} : {action: 'all'};
          const res = await fetch('<?= site_url("notifications/mark-read") ?>', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
          });
          return res.json();
        } catch (err) {
          return {success:false};
        }
      }

      if (markAllReadLink) {
        markAllReadLink.addEventListener('click', async (e) => {
          e.preventDefault();
          await markRead(null);
          await fetchNotifications();
        });
      }

      function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>"'\/]/g, function(s) { return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;'})[s]; });
      }

      // initial fetch + polling
      fetchNotifications();
      setInterval(fetchNotifications, 20000);
      <?php endif; ?>
    });
  </script>
</body>
</html>
