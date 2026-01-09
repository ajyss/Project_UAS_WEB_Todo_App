<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // ✅ HANYA SEKALI

require_once "app/config/Config.php";
require_once "app/config/Database.php";

/* AUTOLOAD CLASS */
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
            return;
        }
    }
});

require_once "app/core/Router.php";

$router = new Router();
$router->run();
