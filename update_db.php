<?php
// Script untuk update database otomatis
// Jalankan file ini di browser: http://localhost/todo_app/update_db.php

define('DB_HOST', 'localhost');
define('DB_NAME', 'todo_app');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek apakah kolom due_date sudah ada
    $result = $pdo->query("SHOW COLUMNS FROM tasks LIKE 'due_date'");
    $exists = $result->fetch();

    if (!$exists) {
        // Tambahkan kolom due_date
        $sql = "ALTER TABLE tasks ADD COLUMN due_date DATE AFTER priority";
        $pdo->exec($sql);

        echo "<h2 style='color: green;'>✅ Database berhasil diupdate!</h2>";
        echo "<p>Kolom 'due_date' telah ditambahkan ke tabel tasks.</p>";
        echo "<p><a href='http://localhost/todo_app'>Kembali ke aplikasi</a></p>";
    } else {
        echo "<h2 style='color: blue;'>ℹ️ Database sudah up-to-date!</h2>";
        echo "<p>Kolom 'due_date' sudah ada di tabel tasks.</p>";
        echo "<p><a href='http://localhost/todo_app'>Kembali ke aplikasi</a></p>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Error updating database:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Pastikan:</p>";
    echo "<ul>";
    echo "<li>MySQL service sudah running</li>";
    echo "<li>Database 'todo_app' sudah ada</li>";
    echo "<li>Konfigurasi database benar</li>";
    echo "</ul>";
}
?>