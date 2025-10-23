<?php

$db = App::resolve('database');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);

if (!$email) {
    $_SESSION['error_message'] = 'Geçerli bir e-posta adresi giriniz.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

// E-posta zaten kayıtlı mı kontrol et
$existing = $db->query('SELECT * FROM subscribers WHERE email = :email', [
    'email' => $email
])->find();

if ($existing) {
    if ($existing['status'] === 'active') {
        $_SESSION['info_message'] = 'Bu e-posta adresi zaten bültenimize kayıtlı.';
    } else {
        // Yeniden aktif et
        $db->query('UPDATE subscribers SET status = :status, subscribed_at = NOW(), unsubscribed_at = NULL WHERE email = :email', [
            'status' => 'active',
            'email' => $email
        ]);
        $_SESSION['success_message'] = 'Bülten aboneliğiniz yeniden aktif edildi!';
    }
} else {
    // Yeni abone ekle
    $token = bin2hex(random_bytes(32));
    
    $db->query('INSERT INTO subscribers (email, verification_token, ip_address, user_agent) VALUES (:email, :token, :ip, :ua)', [
        'email' => $email,
        'token' => $token,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
        'ua' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255)
    ]);
    
    $_SESSION['success_message'] = 'Bültene başarıyla abone oldunuz! Yeni yazılardan haberdar olacaksınız.';
}

header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
exit;
