<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm animate-fade-in">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle me-3" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.2rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 fw-bold text-primary" style="font-size: 1.5rem;">Edit User</h3>
                            <p class="text-muted mb-0">Ubah role dan informasi user</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="<?= BASE_URL ?>/user/update/<?= $user['id'] ?>" class="edit-user-form">
                        <input type="hidden" name="csrf_token" value="<?= $this->generateCsrfToken() ?>">

                        <!-- User Info Display -->
                        <div class="user-info-card mb-4" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border-radius: 12px; padding: 1.5rem; border: 1px solid rgba(102, 126, 234, 0.1);">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-circle me-3" style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1.5rem; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);">
                                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($user['name']) ?></h5>
                                    <p class="text-muted mb-1"><?= htmlspecialchars($user['email']) ?></p>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        Bergabung <?= date('d M Y', strtotime($user['created_at'] ?? 'now')) ?>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Form -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px; color: #4a5568;">
                                    <i class="bi bi-person me-2"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control"
                                       value="<?= htmlspecialchars($user['name']) ?>"
                                       readonly
                                       style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.875rem 1rem;">
                                <small class="text-muted mt-1 d-block">Nama tidak dapat diubah</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px; color: #4a5568;">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                                <input type="email" class="form-control"
                                       value="<?= htmlspecialchars($user['email']) ?>"
                                       readonly
                                       style="background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.875rem 1rem;">
                                <small class="text-muted mt-1 d-block">Email tidak dapat diubah</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px; color: #4a5568;">
                                <i class="bi bi-shield me-2"></i>Role Pengguna
                            </label>
                            <select name="role" class="form-select" style="border: 2px solid #e2e8f0; border-radius: 8px; padding: 0.875rem 1rem; font-weight: 500;">
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>
                                    👤 User - Akses terbatas
                                </option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>
                                    🛡️ Admin - Akses penuh
                                </option>
                            </select>
                            <small class="text-muted mt-1 d-block">
                                <i class="bi bi-info-circle me-1"></i>
                                Role menentukan hak akses pengguna di sistem
                            </small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 pt-3 border-top">
                            <button type="submit" class="btn btn-primary flex-fill" style="border-radius: 8px; padding: 0.875rem 1.5rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3); transition: all 0.3s ease;">
                                <i class="bi bi-check-circle me-2"></i>Update Role
                            </button>
                            <a href="<?= BASE_URL ?>/user" class="btn btn-outline-secondary" style="border-radius: 8px; padding: 0.875rem 1.5rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;">
                                <i class="bi bi-arrow-left me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* EDIT USER SPECIFIC STYLING */
.edit-user-form .form-control {
    transition: all 0.3s ease !important;
}

.edit-user-form .form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    transform: translateY(-1px) !important;
}

.edit-user-form .form-select {
    transition: all 0.3s ease !important;
}

.edit-user-form .form-select:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    transform: translateY(-1px) !important;
}

.edit-user-form .btn {
    transition: all 0.3s ease !important;
}

.edit-user-form .btn:hover {
    transform: translateY(-2px) !important;
}

.edit-user-form .btn-primary:hover {
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4) !important;
}

.animate-fade-in {
    animation: fadeInUp 0.6s ease-out;
}

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

.user-info-card {
    position: relative;
    overflow: hidden;
}

.user-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .card-body {
        padding: 2rem 1.5rem !important;
    }

    .d-flex.gap-3 {
        flex-direction: column !important;
        gap: 1rem !important;
    }

    .btn {
        width: 100% !important;
    }

    .avatar-circle {
        width: 50px !important;
        height: 50px !important;
        font-size: 1.2rem !important;
    }
}

@media (max-width: 576px) {
    .card-header {
        padding: 2rem 1.5rem !important;
    }

    .card-header h3 {
        font-size: 1.25rem !important;
    }
}
</style>