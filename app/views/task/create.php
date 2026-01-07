<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Tambah Task</h5>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/task/store">
            <input type="hidden" name="csrf_token" value="<?= $this->generateCsrfToken() ?>">
            <div class="mb-3">
                <label class="form-label">Judul Task</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Prioritas</label>
                <select name="priority" class="form-control">
                    <option value="low">Rendah</option>
                    <option value="medium" selected>Sedang</option>
                    <option value="high">Tinggi</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Jatuh Tempo</label>
                <input type="date" name="due_date" class="form-control">
            </div>

            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="<?= BASE_URL ?>/task" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
