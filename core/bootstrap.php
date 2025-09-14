<?php

declare(strict_types=1);

session_start();
generate_csrf_token(); 

require BASE_PATH . '/core/functions.php';
require BASE_PATH . '/core/App.php';

function load_env(string $path): void {
    if (!file_exists($path)) { throw new Exception(".env file not found."); }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) { continue; }
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}
load_env(BASE_PATH . '/.env');

spl_autoload_register(function ($class) {
    $class_path = BASE_PATH . '/core/' . $class . '.php';
    if (file_exists($class_path)) {
        require $class_path;
    }
});

$config = require BASE_PATH . '/core/config.php';
$db = new Database($config['database'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

App::bind('database', $db);

$router = require BASE_PATH . '/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = trim($uri, '/'); 
$uri = '/' . $uri;

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

function verify_csrf_token() {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        http_response_code(403);
        die('CSRF token validation failed.');
    }
    unset($_SESSION['csrf_token']);
}
