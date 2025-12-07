
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - BiyahePH</title>
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
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: center;
            max-width: 1000px;
            width: 100%;
        }

        /* Left Side - Branding */
        .login-branding {
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-branding h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .login-branding p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .branding-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
        }

        .feature-item i {
            font-size: 1.5rem;
            opacity: 0.8;
            min-width: 30px;
        }

        .feature-item span {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        /* Right Side - Login Form */
        .login-card {
            background: white;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
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

        .login-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 2rem;
            color: white;
            text-align: center;
        }

        .login-card-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .login-card-header p {
            opacity: 0.9;
            margin: 0;
            font-size: 0.95rem;
        }

        .login-card-body {
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
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--primary);
        }

        .form-control {
            border: 2px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.875rem 1.125rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        /* Login Button */
        .btn-login {
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

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 204, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
            color: var(--text-muted);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            font-size: 0.875rem;
        }

        /* Footer Link */
        .register-link {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .login-branding {
                text-align: center;
                margin-bottom: 1rem;
            }

            .login-branding h1 {
                font-size: 1.75rem;
            }

            .login-branding p {
                font-size: 0.95rem;
            }

            .branding-features {
                align-items: center;
            }

            .login-card-body {
                padding: 1.75rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1rem;
            }

            .login-card-header {
                padding: 1.5rem;
            }

            .login-card-header h2 {
                font-size: 1.25rem;
            }

            .login-branding h1 {
                font-size: 1.5rem;
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

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Left Side - Branding -->
            <div class="login-branding">
                <h1>Welcome to BiyahePH</h1>
                <p>Your gateway to unforgettable travel experiences across the Philippines</p>
                
                <div class="branding-features">
                    <div class="feature-item">
                        <i class="fas fa-map-location-dot"></i>
                        <span>Explore beautiful destinations</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Book packages with ease</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users"></i>
                        <span>Join guided tours</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-star"></i>
                        <span>Unforgettable memories</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-card">
                <div class="login-card-header">
                    <h2><i class="fas fa-sign-in-alt me-2"></i>Login</h2>
                    <p>Sign in to your account</p>
                </div>

                <div class="login-card-body">
                    <!-- Success Alert -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            <span><?= session()->getFlashdata('success') ?></span>'activity_log('login_success', ['user_id'=>$user['id'], 'user_name'=>$user['name'], 'role'=>$user['role']]);
'
                        </div>
                    <?php endif; ?>

                    <!-- Error Alert -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <span><?= session()->getFlashdata('error') ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form method="post" action="<?= site_url('auth/loginPost') ?>">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i>Username
                            </label>
                            <input type="text" name="username" class="form-control" placeholder="Enter your username" required value="<?= esc(old('username')) ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>Password
                            </label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>

                        <button type="submit" class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt"></i>Login
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="divider">
                        <span>New to BiyahePH?</span>
                    </div>

                    <!-- Register Link -->
                    <div class="register-link">
                        Don't have an account? 
                        <a href="<?= site_url('auth/register') ?>">
                            <i class="fas fa-user-plus me-1"></i>Register here
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>