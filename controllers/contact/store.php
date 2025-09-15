<?php

$db = App::resolve('database');
$errors = [];

$ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];

$totalMessages = $db->query('SELECT count(*) as count FROM messages WHERE ip_address = :ip_address', [':ip_address' => $ip_address])->find()['count'];
$lastMessage = $db->query('SELECT created_at FROM messages WHERE ip_address = :ip_address ORDER BY created_at DESC LIMIT 1', [':ip_address' => $ip_address])->find();

if ($lastMessage) {
    $lastMessageTime = strtotime($lastMessage['created_at']);
    $currentTime = time();
    
    // Kural mesajdan sonra limit 120 saate, öncesinde 24 saate ayarlanır.
    $limitHours = ($totalMessages >= 3) ? 120 : 24;
    $limitSeconds = $limitHours * 3600;

    if (($currentTime - $lastMessageTime) < $limitSeconds) {
        $errors['rate_limit'] = "Çok sık mesaj gönderiyorsunuz. Lütfen daha sonra tekrar deneyin.";
    }
}

if (empty($errors)) {
    $turnstileToken = $_POST['cf-turnstile-response'] ?? null;
    if (!$turnstileToken || !verify_turnstile($turnstileToken, $ip_address)) {
        $errors['turnstile'] = 'Güvenlik doğrulaması başarısız oldu. Lütfen sayfayı yenileyip tekrar deneyin.';
    }
}

if (empty($errors)) {
    if (empty($_POST['name'])) {
        $errors['name'] = 'İsim alanı zorunludur.';
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Geçerli bir e-posta adresi girin.';
    }
    if (empty($_POST['message'])) {
        $errors['message'] = 'Mesaj alanı zorunludur.';
    }
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $errors['csrf'] = 'Güvenlik hatası. Lütfen sayfayı yenileyip tekrar deneyin.';
    }
}

// --- 4. HATA VARSA FORMA GERİ GÖNDER ---
if (!empty($errors)) {
    return view('contact/create.php', [
        'title' => 'İletişim',
        'description' => 'Bizimle iletişime geçin.',
        'errors' => $errors,
        'old' => $_POST
    ]);
}

// --- 5. MESAJI KAYDET ---
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