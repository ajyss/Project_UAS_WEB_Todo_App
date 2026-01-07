<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Edit Task</h5>

        <form method="POST" action="<?= BASE_URL ?>/task/update/<?= $task['id'] ?>">
            <input type="hidden" name="csrf_token" value="<?= $this->generateCsrfToken() ?>">
            <div class="mb-3">
                <label class="form-label">Judul Task</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="<?= htmlspecialchars($task['title']) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($task['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="pending" <?= $task['status']=='pending'?'selected':'' ?>>Belum Selesai</option>
                    <option value="completed" <?= $task['status']=='completed'?'selected':'' ?>>Selesai</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Prioritas</label>
                <select name="priority" class="form-select">
                    <option value="low" <?= $task['priority']=='low'?'selected':'' ?>>Rendah</option>
                    <option value="medium" <?= $task['priority']=='medium'?'selected':'' ?>>Sedang</option>
                    <option value="high" <?= $task['priority']=='high'?'selected':'' ?>>Tinggi</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Jatuh Tempo</label>
                <input type="date" name="due_date" class="form-control" value="<?= $task['due_date'] ?? '' ?>">
            </div>

            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="<?= BASE_URL ?>/task" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
