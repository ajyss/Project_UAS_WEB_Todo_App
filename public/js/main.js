/* ==========================
   TASKFLOW UX SCRIPT
   ========================== */

/* 1. Konfirmasi hapus task */
function confirmDelete() {
    return confirm("Apakah Anda yakin ingin menghapus task ini?");
}

/* 2. Auto focus input pertama */
document.addEventListener("DOMContentLoaded", () => {
    const firstInput = document.querySelector("input, textarea");
    if (firstInput) firstInput.focus();
});

/* 3. Validasi form task */
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");

    if (form) {
        form.addEventListener("submit", function (e) {
            const title = document.querySelector("input[name='title']");
            if (title && title.value.trim() === "") {
                showAlert("Judul task wajib diisi!", "danger");
                e.preventDefault();
            }
        });
    }
});

/* 4. Highlight task completed */
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".status-completed").forEach(el => {
        el.closest("tr").style.background = "#f1f8f5";
    });
});

/* 5. Loading effect pada button */
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", () => {
            const btn = form.querySelector("button[type='submit']");
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm"></span>
                    Processing...
                `;
            }
        });
    });
});

/* 6. Alert notification (custom, elegan) */
function showAlert(message, type = "success") {
    const alertBox = document.createElement("div");
    alertBox.className = `alert alert-${type} shadow position-fixed top-0 end-0 m-4`;
    alertBox.style.zIndex = "9999";
    alertBox.innerHTML = message;

    document.body.appendChild(alertBox);

    setTimeout(() => {
        alertBox.remove();
    }, 3000);
}
