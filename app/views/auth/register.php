<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | TaskFlow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/ultra_style.css?v=<?= time() ?>">

    <style>
        /* REGISTER PAGE SPECIFIC STYLING */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
        }

        .login-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1.5" fill="rgba(255,255,255,0.02)"/><circle cx="50" cy="10" r="0.8" fill="rgba(255,255,255,0.04)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 10;
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-card h2 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .login-card .text-muted {
            color: #718096 !important;
            font-size: 0.95rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-form .form-control {
            border: 2px solid #e2e8f0 !important;
            border-radius: 12px !important;
            padding: 1rem 1.2rem !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            background: rgba(255, 255, 255, 0.9) !important;
            margin-bottom: 1rem !important;
        }

        .register-form .form-control:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1) !important;
            transform: translateY(-2px) !important;
            background: white !important;
        }

        .register-form .form-label {
            font-weight: 600 !important;
            color: #2d3748 !important;
            margin-bottom: 0.5rem !important;
            font-size: 0.9rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .register-form .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 1rem 2rem !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
            letter-spacing: 0.5px !important;
            text-transform: uppercase !important;
            width: 100% !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
        }

        .register-form .btn-primary:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
        }

        .register-form .btn-primary i {
            margin-right: 0.5rem;
        }

        .alert {
            border-radius: 12px !important;
            border: none !important;
            font-weight: 500 !important;
            text-align: center !important;
            margin-bottom: 1.5rem !important;
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.85rem;
        }

        .password-strength.weak { color: #e53e3e; }
        .password-strength.medium { color: #dd6b20; }
        .password-strength.strong { color: #38a169; }

        /* RESPONSIVE */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem !important;
                margin: 1rem !important;
                max-width: none !important;
            }

            .login-card h2 {
                font-size: 1.8rem !important;
            }
        }
    </style>
</head>

<body class="login-page">

<div class="login-wrapper">
    <div class="login-card">

        <div class="text-center mb-4">
            <h2>Daftar Akun</h2>
            <p class="text-muted">Bergabunglah dengan TaskFlow untuk mengelola tugas Anda</p>
        </div>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="bi bi-check-circle me-2"></i>
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/auth/register" class="register-form">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name"
                           class="form-control"
                           placeholder="John Doe"
                           required
                           autocomplete="name"
                           value="<?= $_POST['name'] ?? '' ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           placeholder="name@example.com"
                           required
                           autocomplete="email"
                           value="<?= $_POST['email'] ?? '' ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control"
                       placeholder="Minimal 6 karakter"
                       required
                       autocomplete="new-password"
                       minlength="6">
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="confirm_password"
                       class="form-control"
                       placeholder="Ulangi password"
                       required
                       autocomplete="new-password"
                       minlength="6">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Daftar Akun
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                Sudah punya akun?
                <a href="<?= BASE_URL ?>/auth/login" class="text-decoration-none fw-semibold"
                   style="color: #667eea;">Masuk sekarang</a>
            </p>
        </div>

    </div>
</div>
            <h2 class="fw-bold">TaskFlow</h2>
            <p class="text-muted mb-0">Buat akun Anda</p>
        </div>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/auth/register">
            <input type="hidden" name="csrf_token" value="<?= $this->generateCsrfToken() ?>">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name"
                       class="form-control form-control-lg"
                       placeholder="Nama lengkap Anda"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                       class="form-control form-control-lg"
                       placeholder="name@example.com"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control form-control-lg"
                       placeholder="••••••••"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password"
                       class="form-control form-control-lg"
                       placeholder="••••••••"
                       required>
            </div>

            <button class="btn btn-primary w-100 btn-lg">
                <i class="bi bi-person-plus"></i> Daftar
            </button>
        </form>

        <div class="text-center mt-3">
            <p class="mb-0">Sudah punya akun? <a href="<?= BASE_URL ?>/auth" class="text-decoration-none">Masuk di sini</a></p>
        </div>

        <div class="text-center mt-4 text-muted small">
            © <?= date('Y') ?> TaskFlow App
        </div>

    </div>
</div>

</body>
</html>