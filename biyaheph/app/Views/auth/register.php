
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - BiyahePH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0066cc;
            --primary-dark: #0052a3;
            --secondary: #00a8e8;
            --success: #10b981;
            --danger: #ef4444;
            --light: #f8fafc;
            --border: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        /* Main Container */
        .register-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .register-card {
            background: white;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
            max-width: 500px;
            width: 100%;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 2rem;
            color: white;
            text-align: center;
        }

        .register-card-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .register-card-header p {
            opacity: 0.9;
            margin: 0;
            font-size: 0.95rem;
        }

        .register-card-body {
            padding: 2.5rem;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label i {
            color: var(--primary);
        }

        .form-control {
            border: 2px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--danger);
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .invalid-feedback {
            display: block;
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }

        /* Role Selection */
        .role-selection {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .role-option {
            position: relative;
        }

        .role-option input[type="radio"] {
            display: none;
        }

        .role-option label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border: 2px solid var(--border);
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0;
            background: white;
        }

        .role-option input[type="radio"]:checked + label {
            border-color: var(--primary);
            background: rgba(0, 102, 204, 0.05);
        }

        .role-option label:hover {
            border-color: var(--primary);
        }

        .role-icon {
            font-size: 1.5rem;
            color: var(--primary);
        }

        /* Admin Checkbox */
        .admin-request-section {
            background: rgba(245, 158, 11, 0.05);
            border: 2px solid #fcd34d;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: none;
        }

        .admin-request-section.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        .admin-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            cursor: pointer;
        }

        .admin-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .admin-info {
            flex: 1;
        }

        .admin-info h5 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 0.3rem;
        }

        .admin-info p {
            font-size: 0.85rem;
            color: #b45309;
            margin: 0;
            line-height: 1.5;
        }

        /* Register Button */
        .btn-register {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.875rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 204, 0.3);
            color: white;
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-link {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 1rem;
            }

            .register-card-header {
                padding: 1.5rem;
            }

            .register-card-header h2 {
                font-size: 1.25rem;
            }

            .register-card-body {
                padding: 1.5rem;
            }

            .role-selection {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-plane"></i>BiyahePH
            </a>
            <span class="text-muted ms-auto" style="font-size: 0.9rem;">Your Travel Companion</span>
        </div>
    </nav>

    <!-- Register Container -->
    <div class="register-container">
        <div class="register-card">
            <div class="register-card-header">
                <h2><i class="fas fa-user-plus me-2"></i>Create Account</h2>
                <p>Join BiyahePH and start exploring</p>
            </div>

            <div class="register-card-body">
                <!-- Success Alert -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span><?= session()->getFlashdata('success') ?></span>
                    </div>
                <?php endif; ?>

                <!-- Error Alert -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <!-- Register Form -->
                <form method="post" action="<?= site_url('auth/registerPost') ?>" id="registerForm">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user-tag"></i>Full Name
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required value="<?= esc(old('name')) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>Username
                        </label>
                        <input type="text" name="username" class="form-control" placeholder="Choose a username" required value="<?= esc(old('username')) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>Email
                        </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required value="<?= esc(old('email')) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>Password
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="Create a password (min 6 characters)" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>Confirm Password
                        </label>
                        <input type="password" name="password_confirm" class="form-control" placeholder="Confirm your password" required>
                    </div>

                    <!-- Account Type Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-briefcase"></i>Account Type
                        </label>
                        <div class="role-selection" id="roleSelection">
                            <div class="role-option">
                                <input type="radio" id="tourist" name="role" value="tourist" required checked onchange="toggleAdminRequest()">
                                <label for="tourist">
                                    <span class="role-icon"><i class="fas fa-user-tie"></i></span>
                                    <span>Tourist</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" id="admin" name="role" value="admin" onchange="toggleAdminRequest()">
                                <label for="admin">
                                    <span class="role-icon"><i class="fas fa-shield"></i></span>
                                    <span>Admin</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Request Section -->
                    <div class="admin-request-section" id="adminRequestSection">
                        <label class="admin-checkbox">
                            <input type="checkbox" name="request_admin" id="requestAdminCheckbox">
                            <div class="admin-info">
                                <h5><i class="fas fa-info-circle me-1"></i>Request Admin Access</h5>
                                <p>Your admin account will be reviewed by existing administrators. You'll receive approval notification via email once reviewed.</p>
                            </div>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-register w-100">
                        <i class="fas fa-user-plus"></i>Create Account
                    </button>
                </form>

                <!-- Login Link -->
                <div class="login-link">
                    Already have an account? 
                    <a href="<?= site_url('auth/login') ?>">
                        <i class="fas fa-sign-in-alt me-1"></i>Login here
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleAdminRequest() {
            const adminRadio = document.getElementById('admin');
            const adminSection = document.getElementById('adminRequestSection');
            const requestCheckbox = document.getElementById('requestAdminCheckbox');
            
            if (adminRadio.checked) {
                adminSection.classList.add('show');
                requestCheckbox.checked = true;
            } else {
                adminSection.classList.remove('show');
                requestCheckbox.checked = false;
            }
        }

        // Validate passwords match
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const passwordConfirm = document.querySelector('input[name="password_confirm"]').value;
            
            if (password !== passwordConfirm) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters!');
                return false;
            }
        });
    </script>
</body>
</html>