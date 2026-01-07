<?php

class Router
{
    public function run()
    {
        // Prefer explicit url parameter (from .htaccess), else derive from REQUEST_URI
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
        } else {
            $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            // Remove base path if BASE_URL points to a subfolder
            $base = rtrim(parse_url(BASE_URL, PHP_URL_PATH) ?? '/', '/');
            if ($base && strpos($requestPath, $base) === 0) {
                $requestPath = substr($requestPath, strlen($base));
            }
            $url = trim($requestPath, '/');
        }

        if ($url === '') {
            $controllerName = 'AuthController';
            $method = 'index';
            $params = [];
        } else {
            // Parse URL path
            $urlParts = array_values(array_filter(explode('/', $url), function($p){ return $p !== ''; }));

            // If URL starts with project folder name (e.g., /todo_app/task), remove it
            $projectFolder = basename(dirname(__DIR__, 2)); // ../.. => project root folder name
            if (!empty($urlParts) && strtolower($urlParts[0]) === strtolower($projectFolder)) {
                array_shift($urlParts);
            }

            // Fallback: if still empty, go to auth index
            if (empty($urlParts)) {
                $controllerName = 'AuthController';
                $method = 'index';
                $params = [];
            } else {
                // special debug route
                if (strtolower($urlParts[0]) === 'debug') {
                    $this->debug();
                }

                $controllerName = ucfirst($urlParts[0]) . 'Controller';
                $method = $urlParts[1] ?? 'index';

                // Get parameters from URL path (for REST-style URLs)
                $params = array_slice($urlParts, 2);
            }
        }

        $controllerFile = "../app/controllers/$controllerName.php";

        if (!file_exists($controllerFile)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo "<h1>404 Not Found</h1>\n";
            echo "Controller <strong>" . htmlspecialchars($controllerName) . "</strong> tidak ditemukan.<br>";
            echo "<a href=\"" . htmlspecialchars(BASE_URL) . "\">Kembali ke beranda</a>";
            exit;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
            echo "Controller file ditemukan tetapi kelas <strong>" . htmlspecialchars($controllerName) . "</strong> tidak didefinisikan.";
            exit;
        }

        $controller = new $controllerName;

        if (!method_exists($controller, $method)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo "Method <strong>" . htmlspecialchars($method) . "</strong> tidak ditemukan di controller <strong>" . htmlspecialchars($controllerName) . "</strong>.";
            exit;
        }

        call_user_func_array([$controller, $method], $params);
    }

    private function debug()
    {
        header('Content-Type: text/html; charset=utf-8');
        echo "<h2>App Debug</h2>";
        echo "<p><strong>BASE_URL:</strong> " . htmlspecialchars(defined('BASE_URL') ? BASE_URL : '') . "</p>";
        echo "<p><strong>REQUEST_URI:</strong> " . htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') . "</p>";
        echo "<p><strong>Script Name:</strong> " . htmlspecialchars($_SERVER['SCRIPT_NAME'] ?? '') . "</p>";
        echo "<p><strong>Project folder (detected):</strong> " . htmlspecialchars(basename(dirname(__DIR__, 2))) . "</p>";
        echo "<p><strong>controllers dir exists:</strong> " . (is_dir(__DIR__ . '/../controllers') ? 'yes' : 'no') . "</p>";

        // DB check
        echo "<h3>Database</h3>";
        try {
            require_once __DIR__ . '/../config/Database.php';
            $db = new Database();
            $db->query('SELECT 1');
            echo "<p>DB connection: <strong>OK</strong></p>";
        } catch (Exception $e) {
            echo "<p>DB error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }

        exit;
    }
}
