<?php
    use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

if (empty($_POST['name'])) {
    $errors['name'] = 'İsim alanı zorunludur.';
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Geçerli bir e-posta adresi girin.';
}
if (empty($_POST['message'])) {
    $errors['message'] = 'Mesaj alanı zorunlur.';
}

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $errors['csrf'] = 'Güvenlik hatası. Lütfen sayfayı yenileyip tekrar deneyin.';
}


if (!empty($errors)) {
    return view('contact/create.php', [
        'title' => 'İletişim',
        'description' => 'Bizimle iletişime geçin.',
        'errors' => $errors,
        'old' => $_POST
    ]);
}

$ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];


$db->query('INSERT INTO messages(name, email, message, ip_address, user_agent) VALUES(:name, :email, :message, :ip_address, :user_agent)', [
    'name' => htmlspecialchars($_POST['name']),
    'email' => htmlspecialchars($_POST['email']),
    'message' => htmlspecialchars($_POST['message']),
    'ip_address' => $ip_address,
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
]);


$_SESSION['success_message'] = 'Mesajınız başarıyla gönderildi!';
header('location: /');
exit();