<?php
// Script untuk menambahkan data dummy untuk testing pagination
// Jalankan: http://localhost/todo_app/add_dummy_data.php

define('DB_HOST', 'localhost');
define('DB_NAME', 'todo_app');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek jumlah data saat ini
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tasks");
    $result = $stmt->fetch();
    $currentCount = $result['count'];

    if ($currentCount >= 20) {
        echo "<h2 style='color: blue;'>ℹ️ Data dummy sudah cukup!</h2>";
        echo "<p>Sudah ada $currentCount tugas di database.</p>";
        echo "<p><a href='http://localhost/todo_app'>Kembali ke aplikasi</a></p>";
        exit;
    }

    // Tambahkan 15 data dummy
    $dummyTasks = [
        ['Tugas Matematika', 'Mengerjakan soal integral', 'high', '2024-01-15'],
        ['Belajar PHP', 'Mempelajari MVC pattern', 'medium', '2024-01-20'],
        ['Project UAS', 'Menyelesaikan tugas akhir', 'high', '2024-01-25'],
        ['Olahraga', 'Jogging pagi hari', 'low', '2024-01-10'],
        ['Meeting Tim', 'Diskusi project baru', 'medium', '2024-01-18'],
        ['Baca Buku', 'Novel motivasi', 'low', '2024-01-22'],
        ['Coding Practice', 'Latihan algoritma', 'high', '2024-01-12'],
        ['Design UI', 'Membuat mockup aplikasi', 'medium', '2024-01-28'],
        ['Database Backup', 'Backup data penting', 'high', '2024-01-14'],
        ['Review Code', 'Code review tim', 'medium', '2024-01-16'],
        ['Presentasi', 'Persiapan presentasi', 'high', '2024-01-30'],
        ['Belajar JavaScript', 'Tutorial ES6', 'medium', '2024-01-19'],
        ['Testing Aplikasi', 'Unit testing', 'low', '2024-01-21'],
        ['Dokumentasi', 'Update README', 'low', '2024-01-23'],
        ['Maintenance', 'Update dependencies', 'medium', '2024-01-24']
    ];

    $sql = "INSERT INTO tasks (user_id, title, description, status, priority, due_date) VALUES (?, ?, ?, 'pending', ?, ?)";
    $stmt = $pdo->prepare($sql);

    $added = 0;
    foreach ($dummyTasks as $task) {
        // Cek apakah tugas sudah ada
        $checkStmt = $pdo->prepare("SELECT id FROM tasks WHERE title = ? AND user_id = 1");
        $checkStmt->execute([$task[0]]);
        if (!$checkStmt->fetch()) {
            $stmt->execute([1, $task[0], $task[1], $task[3], $task[2]]);
            $added++;
        }
    }

    echo "<h2 style='color: green;'>✅ Data dummy berhasil ditambahkan!</h2>";
    echo "<p>$added tugas dummy telah ditambahkan.</p>";
    echo "<p>Total tugas sekarang: " . ($currentCount + $added) . "</p>";
    echo "<p><a href='http://localhost/todo_app'>Test pagination sekarang</a></p>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Error menambahkan data dummy:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>