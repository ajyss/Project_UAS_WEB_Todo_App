<?php
$total  = $total ?? 0;
$limit  = $limit ?? 5;
$page   = $page ?? 1;
$search = $search ?? '';
$status = $status ?? 'all';

$totalPages = $limit > 0 ? ceil($total / $limit) : 1;
?>

<!-- ================= STATISTIK DASHBOARD ================= -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <h6 class="text-muted">Total Tugas</h6>
                <h3 class="fw-bold"><?= $stats['total'] ?? 0 ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm text-center">
            <div class="card-body text-warning">
                <h6 class="text-muted">Belum Selesai</h6>
                <h3 class="fw-bold"><?= $stats['pending'] ?? 0 ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm text-center">
            <div class="card-body text-success">
                <h6 class="text-muted">Selesai</h6>
                <h3 class="fw-bold"><?= $stats['completed'] ?? 0 ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- ================= TASK LIST ================= -->
<div class="card mb-4">
    <div class="card-body">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Daftar Tugas</h5>
            <a href="<?= BASE_URL ?>/task/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Task
            </a>
        </div>

        <!-- SEARCH + FILTER -->
        <form method="get" class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari tugas..."
                       value="<?= htmlspecialchars($search) ?>">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>Semua Status</option>
                    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Belum Selesai</option>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Selesai</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Prioritas</th>
                    <th>Tanggal Jatuh Tempo</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Tidak ada tugas ditemukan
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($tasks as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['title']) ?></td>
                        <td><?= htmlspecialchars(substr($t['description'] ?? '', 0, 50)) ?><?php if (strlen($t['description'] ?? '') > 50) echo '...'; ?></td>
                        <td>
                            <span class="badge bg-secondary">
                                <?php 
                                $priorities = ['low' => 'Rendah', 'medium' => 'Sedang', 'high' => 'Tinggi'];
                                echo $priorities[$t['priority'] ?? 'medium'];
                                ?>
                            </span>
                        </td>
                        <td><?= $t['due_date'] ? date('d/m/Y', strtotime($t['due_date'])) : '-' ?></td>
                        <td>
                            <span class="badge <?= $t['status'] === 'completed' ? 'bg-success' : 'bg-warning' ?>">
                                <?php 
                                $statuses = ['pending' => 'Belum Selesai', 'completed' => 'Selesai'];
                                echo $statuses[$t['status']];
                                ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>/task/edit/<?= $t['id'] ?>"
                                class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="<?= BASE_URL ?>/task/delete/<?= $t['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <?php if ($totalPages > 1): ?>
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <!-- Previous Button -->
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?= BASE_URL ?>/task?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&status=<?= $status ?>">
                            <i class="bi bi-chevron-left"></i> Sebelumnya
                        </a>
                    </li>
                <?php endif; ?>

                <?php
                // Pagination logic - show max 5 pages
                $startPage = max(1, $page - 2);
                $endPage = min($totalPages, $page + 2);

                // Adjust if we're near the beginning or end
                if ($endPage - $startPage < 4) {
                    if ($startPage == 1) {
                        $endPage = min($totalPages, $startPage + 4);
                    } elseif ($endPage == $totalPages) {
                        $startPage = max(1, $endPage - 4);
                    }
                }

                // Show first page if not in range
                if ($startPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?= BASE_URL ?>/task?page=1&search=<?= urlencode($search) ?>&status=<?= $status ?>">1</a>
                    </li>
                    <?php if ($startPage > 2): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link"
                           href="<?= BASE_URL ?>/task?page=<?= $i ?>&search=<?= urlencode($search) ?>&status=<?= $status ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <!-- Show last page if not in range -->
                <?php if ($endPage < $totalPages): ?>
                    <?php if ($endPage < $totalPages - 1): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?= BASE_URL ?>/task?page=<?= $totalPages ?>&search=<?= urlencode($search) ?>&status=<?= $status ?>">
                            <?= $totalPages ?>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Next Button -->
                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link"
                           href="<?= BASE_URL ?>/task?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&status=<?= $status ?>">
                            Selanjutnya <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Pagination Info -->
        <div class="text-center text-muted small mt-2">
            Halaman <?= $page ?> dari <?= $totalPages ?> (Menampilkan maksimal 5 tugas per halaman)
        </div>
        <?php endif; ?>

    </div>
</div>
