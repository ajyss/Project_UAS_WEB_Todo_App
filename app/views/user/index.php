<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm animate-fade-in">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold text-primary" style="font-size: 1.75rem;">Manajemen User</h3>
                            <p class="text-muted mb-0">Kelola pengguna sistem TaskFlow</p>
                        </div>
                        <div class="stats-info">
                            <div class="d-flex gap-3">
                                <div class="text-center">
                                    <div class="fw-bold text-primary" style="font-size: 1.5rem;"><?= count($users) ?></div>
                                    <small class="text-muted">Total User</small>
                                </div>
                                <div class="text-center">
                                    <div class="fw-bold text-success" style="font-size: 1.5rem;"><?= count(array_filter($users, fn($u) => $u['role'] === 'admin')) ?></div>
                                    <small class="text-muted">Admin</small>
                                </div>
                                <div class="text-center">
                                    <div class="fw-bold text-info" style="font-size: 1.5rem;"><?= count(array_filter($users, fn($u) => $u['role'] === 'user')) ?></div>
                                    <small class="text-muted">User</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 fw-semibold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                        <i class="bi bi-person me-2 text-primary"></i>Nama
                                    </th>
                                    <th class="border-0 fw-semibold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                        <i class="bi bi-envelope me-2 text-primary"></i>Email
                                    </th>
                                    <th class="border-0 fw-semibold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                        <i class="bi bi-shield me-2 text-primary"></i>Role
                                    </th>
                                    <th class="border-0 fw-semibold text-uppercase text-center" style="font-size: 0.85rem; letter-spacing: 0.5px; width: 150px;">
                                        <i class="bi bi-gear me-2 text-primary"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $index => $u): ?>
                                    <tr class="align-middle" style="animation-delay: <?= $index * 0.1 ?>s;">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3" style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1rem;">
                                                    <?= strtoupper(substr($u['name'], 0, 1)) ?>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold text-dark"><?= htmlspecialchars($u['name']) ?></div>
                                                    <small class="text-muted">ID: <?= $u['id'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark"><?= htmlspecialchars($u['email']) ?></div>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                Bergabung <?= date('d M Y', strtotime($u['created_at'] ?? 'now')) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge fs-6 px-3 py-2 <?= $u['role'] === 'admin' ? 'bg-danger' : 'bg-secondary' ?>"
                                                  style="border-radius: 20px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                                                <i class="bi bi-shield-check me-1"></i>
                                                <?= $u['role'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($u['role'] !== 'admin'): ?>
                                                <div class="btn-group" role="group">
                                                    <a href="<?= BASE_URL ?>/user/edit/<?= $u['id'] ?>"
                                                       class="btn btn-outline-warning btn-sm me-1"
                                                       style="border-radius: 8px; padding: 0.375rem 0.75rem;"
                                                       title="Edit User">
                                                       <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="<?= BASE_URL ?>/user/delete/<?= $u['id'] ?>"
                                                       class="btn btn-outline-danger btn-sm"
                                                       style="border-radius: 8px; padding: 0.375rem 0.75rem;"
                                                       onclick="return confirm('Apakah Anda yakin ingin menghapus user <?= htmlspecialchars($u['name']) ?>?')"
                                                       title="Hapus User">
                                                       <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <span class="badge bg-light text-muted px-3 py-2" style="border-radius: 20px;">
                                                    <i class="bi bi-shield-lock me-1"></i>Protected
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if (empty($users)): ?>
                    <div class="card-body text-center py-5">
                        <div style="font-size: 3rem; color: #cbd5e0; margin-bottom: 1rem;">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5 class="text-muted mb-2">Belum ada user</h5>
                        <p class="text-muted mb-0">User akan muncul di sini setelah ada yang mendaftar</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
/* USER MANAGEMENT SPECIFIC STYLING */
.stats-info {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 16px;
    padding: 1.5rem;
    border: 1px solid rgba(102, 126, 234, 0.2);
}

.stats-info .fw-bold {
    font-size: 1.5rem !important;
    line-height: 1;
}

.table-responsive {
    border-radius: 0 0 16px 16px;
    overflow: hidden;
}

.table thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
    border-bottom: 2px solid #e2e8f0 !important;
    padding: 1.25rem 1rem !important;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table tbody tr {
    transition: all 0.2s ease !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.table tbody tr:hover {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.02) 0%, rgba(118, 75, 162, 0.02) 100%) !important;
    transform: translateX(4px) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
}

.table tbody td {
    padding: 1.25rem 1rem !important;
    vertical-align: middle !important;
    border: none !important;
}

.avatar-circle {
    flex-shrink: 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-group .btn {
    border-radius: 8px !important;
    padding: 0.375rem 0.75rem !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
}

.btn-group .btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.badge {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px !important;
    border-radius: 20px !important;
    padding: 0.5rem 1rem !important;
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

/* RESPONSIVE DESIGN */
@media (max-width: 768px) {
    .stats-info {
        margin-top: 1rem;
    }

    .stats-info .d-flex {
        flex-direction: column;
        gap: 1rem;
    }

    .table-responsive {
        font-size: 0.9rem;
    }

    .avatar-circle {
        width: 35px !important;
        height: 35px !important;
        font-size: 0.9rem !important;
    }

    .btn-group {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn-group .btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .card-header {
        padding: 1.5rem !important;
    }

    .card-header h3 {
        font-size: 1.5rem !important;
    }

    .stats-info {
        padding: 1rem !important;
    }
}
</style>
