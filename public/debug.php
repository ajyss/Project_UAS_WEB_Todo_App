<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Todo App - Debug Page</h2>";

// File checks
$files = [
    'public/index.php' => __DIR__ . '/index.php',
    'app/config/Config.php' => __DIR__ . '/../app/config/Config.php',
    'app/core/Router.php' => __DIR__ . '/../app/core/Router.php',
    '.htaccess (project root)' => __DIR__ . '/../.htaccess',
    'database/todo_app.sql' => __DIR__ . '/../database/todo_app.sql',
];

echo "<h3>File existence</h3>";
echo "<ul>";
foreach ($files as $label => $path) {
    echo '<li>' . htmlspecialchars($label) . ': ' . (file_exists($path) ? '<strong style="color:green">FOUND</strong>' : '<strong style="color:red">MISSING</strong>') . ' (' . htmlspecialchars($path) . ')</li>';
}
echo "</ul>";

// BASE_URL
require_once __DIR__ . '/../app/config/Config.php';
echo "<h3>Config</h3>";
echo "<pre>BASE_URL = " . (defined('BASE_URL') ? BASE_URL : 'NOT DEFINED') . "</pre>";

// Router check
echo "<h3>Request info</h3>";
echo "<pre>REQUEST_URI: " . htmlspecialchars(
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $_SERVER['REQUEST_URI']
) . "\n";
echo "PATH_INFO: " . (isset($_SERVER['PATH_INFO']) ? htmlspecialchars($_SERVER['PATH_INFO']) : 'N/A') . "\n";
echo "QUERY_STRING: " . htmlspecialchars($_SERVER['QUERY_STRING'] ?? '') . "\n";
echo "</pre>";

// Try DB connection
echo "<h3>Database connection</h3>";
require_once __DIR__ . '/../app/config/Database.php';
try {
    $db = new Database();
    $pdo = $db->getPDO();
    $stmt = $pdo->query('SELECT COUNT(*) as c FROM tasks');
    $count = $stmt->fetch();
    echo "<p>DB OK — tasks count: " . intval($count['c']) . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>DB ERROR: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Display sample links
echo "<h3>Quick links</h3>";
echo "<ul>";
echo "<li><a href='./'>/ (public root)</a></li>";
echo "<li><a href='./index.php'>index.php</a></li>";
echo "<li><a href='./task?page=1'>/task?page=1</a></li>";
echo "<li><a href='./task?page=2'>/task?page=2</a></li>";
echo "</ul>";

echo "<p>Open this file in the browser and tell me the outputs shown above.</p>";
?>