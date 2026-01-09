<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TaskFlow</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom CSS - ULTRA MODERN VERSION -->
<link href="<?= BASE_URL ?>/css/ultra_style.css?v=<?= time() ?>" rel="stylesheet">

<style>
/* PROFESSIONAL & ELEGANT STYLING */

/* Elegant Color Palette */
:root {
    --elegant-primary: #1a365d;
    --elegant-secondary: #2d3748;
    --elegant-accent: #4a5568;
    --elegant-light: #f7fafc;
    --elegant-border: #e2e8f0;
    --elegant-shadow: rgba(0, 0, 0, 0.1);
    --elegant-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Elegant Body */
body {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
    background-attachment: fixed !important;
    font-family: 'Inter', 'Segoe UI', -apple-system, sans-serif !important;
    color: var(--elegant-secondary) !important;
    line-height: 1.6 !important;
    margin: 0 !important;
    padding: 0 !important;
    min-height: 100vh !important;
}

/* Elegant Navbar */
.navbar {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px) !important;
    border-bottom: 1px solid var(--elegant-border) !important;
    box-shadow: 0 4px 20px var(--elegant-shadow) !important;
    padding: 1.2rem 2rem !important;
    margin-bottom: 2rem !important;
}

.navbar-brand {
    font-weight: 700 !important;
    font-size: 1.8rem !important;
    color: var(--elegant-primary) !important;
    letter-spacing: -0.5px !important;
    text-decoration: none !important;
}

/* Elegant Cards */
.card {
    background: rgba(255, 255, 255, 0.98) !important;
    border: 1px solid var(--elegant-border) !important;
    border-radius: 16px !important;
    box-shadow: 0 8px 32px var(--elegant-shadow) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    overflow: hidden !important;
    margin-bottom: 1.5rem !important;
}

.card:hover {
    transform: translateY(-4px) !important;
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15) !important;
    border-color: var(--elegant-accent) !important;
}

.card-body {
    padding: 2rem !important;
}

.card-title {
    color: var(--elegant-primary) !important;
    font-weight: 600 !important;
    margin-bottom: 1rem !important;
    font-size: 1.25rem !important;
}

/* Elegant Buttons */
.btn {
    border-radius: 8px !important;
    font-weight: 600 !important;
    padding: 0.75rem 1.5rem !important;
    border: 1px solid transparent !important;
    transition: all 0.2s ease !important;
    font-size: 0.95rem !important;
    letter-spacing: 0.5px !important;
    text-transform: none !important;
}

.btn-primary {
    background: var(--elegant-gradient) !important;
    color: white !important;
    border-color: transparent !important;
}

.btn-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3) !important;
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
}

.btn-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%) !important;
    color: white !important;
}

.btn-success:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3) !important;
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%) !important;
}

.btn-danger {
    background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%) !important;
    color: white !important;
}

.btn-danger:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(245, 101, 101, 0.3) !important;
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%) !important;
}

.btn-outline-secondary {
    color: var(--elegant-accent) !important;
    border-color: var(--elegant-accent) !important;
    background: transparent !important;
}

.btn-outline-secondary:hover {
    background: var(--elegant-accent) !important;
    color: white !important;
    transform: translateY(-2px) !important;
}

/* Elegant Table */
.table {
    background: rgba(255, 255, 255, 0.95) !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    box-shadow: 0 4px 20px var(--elegant-shadow) !important;
    margin-bottom: 0 !important;
}

.table thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
    color: var(--elegant-primary) !important;
    font-weight: 600 !important;
    border: none !important;
    padding: 1.2rem !important;
    font-size: 0.9rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

.table tbody tr {
    transition: all 0.2s ease !important;
    border-bottom: 1px solid var(--elegant-border) !important;
}

.table tbody tr:hover {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.02) 0%, rgba(118, 75, 162, 0.02) 100%) !important;
}

.table tbody td {
    padding: 1rem !important;
    vertical-align: middle !important;
    color: var(--elegant-secondary) !important;
    font-weight: 500 !important;
}

/* Elegant Forms */
.form-control, .form-select {
    border: 2px solid var(--elegant-border) !important;
    border-radius: 8px !important;
    padding: 0.875rem 1rem !important;
    font-size: 0.95rem !important;
    transition: all 0.2s ease !important;
    background: rgba(255, 255, 255, 0.8) !important;
    color: var(--elegant-secondary) !important;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    background: white !important;
    transform: translateY(-1px) !important;
}

.form-label {
    font-weight: 600 !important;
    color: var(--elegant-primary) !important;
    margin-bottom: 0.5rem !important;
    font-size: 0.9rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

/* Elegant Pagination */
.pagination {
    gap: 0.25rem !important;
    margin-top: 2rem !important;
}

.page-link {
    border-radius: 8px !important;
    border: 2px solid var(--elegant-border) !important;
    color: var(--elegant-accent) !important;
    font-weight: 500 !important;
    padding: 0.5rem 0.75rem !important;
    transition: all 0.2s ease !important;
    background: rgba(255, 255, 255, 0.8) !important;
    margin: 0 2px !important;
}

.page-link:hover {
    background: var(--elegant-gradient) !important;
    border-color: transparent !important;
    color: white !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2) !important;
}

.page-item.active .page-link {
    background: var(--elegant-gradient) !important;
    border-color: var(--elegant-gradient) !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2) !important;
}

/* Elegant Badges */
.badge {
    border-radius: 20px !important;
    font-weight: 600 !important;
    padding: 0.375rem 0.875rem !important;
    font-size: 0.75rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

.badge.bg-secondary {
    background: linear-gradient(135deg, #718096 0%, #4a5568 100%) !important;
    color: white !important;
}

.badge.bg-success {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%) !important;
    color: white !important;
}

.badge.bg-warning {
    background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%) !important;
    color: white !important;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%) !important;
    color: white !important;
}

/* Elegant Alerts */
.alert {
    border-radius: 12px !important;
    border: none !important;
    font-weight: 500 !important;
    padding: 1rem 1.5rem !important;
    box-shadow: 0 4px 16px var(--elegant-shadow) !important;
    backdrop-filter: blur(10px) !important;
}

.alert-danger {
    background: linear-gradient(135deg, rgba(245, 101, 101, 0.1) 0%, rgba(229, 62, 62, 0.1) 100%) !important;
    color: #c53030 !important;
    border-left: 4px solid #f56565 !important;
}

.alert-success {
    background: linear-gradient(135deg, rgba(72, 187, 120, 0.1) 0%, rgba(56, 161, 105, 0.1) 100%) !important;
    color: #2f855a !important;
    border-left: 4px solid #48bb78 !important;
}

.alert-warning {
    background: linear-gradient(135deg, rgba(237, 137, 54, 0.1) 0%, rgba(221, 107, 32, 0.1) 100%) !important;
    color: #c05621 !important;
    border-left: 4px solid #ed8936 !important;
}

/* Elegant Stats Cards */
.bg-light {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
    color: var(--elegant-primary) !important;
}

/* Elegant Responsive */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.5rem !important;
    }

    .card-body {
        padding: 1.5rem !important;
    }

    .btn {
        padding: 0.625rem 1.25rem !important;
        font-size: 0.9rem !important;
    }

    .table-responsive {
        font-size: 0.9rem !important;
    }
}

/* Elegant Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeInUp 0.6s ease-out;
}

/* Elegant Hover Effects */
.hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease !important;
}

.hover-lift:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}
</style>
</head>

<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand fw-semibold">TaskFlow</span>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="text-white small">
            <?= htmlspecialchars($_SESSION['user']['name']) ?> |
            <a href="<?= BASE_URL ?>/auth/logout" class="text-danger text-decoration-none">Logout</a>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <a href="<?= BASE_URL ?>/user" class="text-warning me-3">Kelola User</a>
    <?php endif; ?>

</nav>

<div class="container mt-4">
