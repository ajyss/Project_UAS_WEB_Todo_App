<?php

// Determine BASE_URL dynamically when available (web request).
if (!defined('BASE_URL')) {
	if (!empty($_SERVER['HTTP_HOST'])) {
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
		$host = $_SERVER['HTTP_HOST'];
		$scriptName = dirname($_SERVER['SCRIPT_NAME']);
		$basePath = rtrim(str_replace('\\', '/', $scriptName), '/');
		$basePath = ($basePath === '' || $basePath === '/') ? '' : $basePath;
		define('BASE_URL', $protocol . '://' . $host . $basePath . '/');
	} else {
		// CLI fallback (use common local dev path). You can override this manually.
		define('BASE_URL', 'http://localhost/todo_app/');
	}
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'todo_app');
define('DB_USER', 'root');
define('DB_PASS', '');
