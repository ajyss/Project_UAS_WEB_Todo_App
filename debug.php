<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Debug Information</h2>";

// Check current directory
echo "<p><strong>Current Directory:</strong> " . __DIR__ . "</p>";

// Check if required files exist
echo "<h3>File Check</h3>";
$files = [
    'app/config/Config.php',
    'app/config/Database.php', 
    'app/core/Router.php',
    'app/controllers/AuthController.php',
    'app/models/Task.php'
];

foreach ($files as $file) {
    $exists = file_exists($file) ? "✅ EXISTS" : "❌ MISSING";
    echo "<p><strong>$file:</strong> $exists</p>";
}

// Check BASE_URL
echo "<h3>Configuration</h3>";
if (defined('BASE_URL')) {
    echo "<p><strong>BASE_URL:</strong> " . BASE_URL . "</p>";
} else {
    echo "<p><strong>BASE_URL:</strong> ❌ NOT DEFINED</p>";
}

// Test database connection
echo "<h3>Database Test</h3>";
try {
    if (file_exists('app/config/Config.php')) {
        require_once 'app/config/Config.php';
        require_once 'app/config/Database.php';
        $db = new Database();
        $db->query('SELECT 1');
        echo "<p>✅ Database connection: OK</p>";
    } else {
        echo "<p>❌ Config file not found</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
}

// Test autoloader
echo "<h3>Autoloader Test</h3>";
spl_autoload_register(function ($class) {
    $folders = [
        "app/controllers/",
        "app/models/",
        "app/core/"
    ];

    foreach ($folders as $folder) {
        $file = $folder . $class . ".php";
        if (file_exists($file)) {
            require_once $file;
            echo "<p>✅ Loaded: $class from $file</p>";
            return;
        }
    }
    echo "<p>❌ Not found: $class</p>";
});

// Test loading Router
try {
    $router = new Router();
    echo "<p>✅ Router class loaded successfully</p>";
} catch (Exception $e) {
    echo "<p>❌ Router error: " . $e->getMessage() . "</p>";
}
?>
