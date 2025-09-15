<?php

declare(strict_types=1);

function secure_session_start() {
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
    ini_set('session.cookie_samesite', 'Lax');

    session_start();
    
    if (!isset($_SESSION['last_regeneration'])) {
        $_SESSION['last_regeneration'] = time();
    } elseif (time() - $_SESSION['last_regeneration'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

secure_session_start();

generate_csrf_token();

require BASE_PATH . '/core/functions.php';

set_security_headers(); 

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

// --- OTOMATİK YÜKLEYİCİ ---
// Projedeki tüm sınıflar bu fonksiyon sayesinde otomatik olarak yüklenecek.
spl_autoload_register(function ($class) {
    // Örnek: 'core\Router' girdisini 'core/Router.php' yapar
    $class_path = BASE_PATH . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($class_path)) {
        require $class_path;
    }
});


$config = require BASE_PATH . '/core/config.php';

// Otomatik yükleyici sayesinde sınıflar artık doğrudan "new" ile çağrılabilir.
$db = new core\Database($config['database'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
core\App::bind('database', $db);

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
        die('CSRF token validation failed. Lütfen sayfayı yenileyip tekrar deneyin.');
    }
}