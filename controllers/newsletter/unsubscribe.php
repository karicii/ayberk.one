<?php

$db = App::resolve('database');

$token = $_GET['token'] ?? '';

if (empty($token)) {
    $_SESSION['error_message'] = 'Geçersiz abonelik iptali linki.';
    header('Location: /');
    exit;
}

$subscriber = $db->query('SELECT * FROM subscribers WHERE verification_token = :token', [
    'token' => $token
])->find();

if (!$subscriber) {
    $_SESSION['error_message'] = 'Abonelik bulunamadı.';
    header('Location: /');
    exit;
}

if ($subscriber['status'] === 'unsubscribed') {
    $_SESSION['info_message'] = 'Bu e-posta adresi zaten abonelikten çıkmış.';
} else {
    $db->query('UPDATE subscribers SET status = :status, unsubscribed_at = NOW() WHERE id = :id', [
        'status' => 'unsubscribed',
        'id' => $subscriber['id']
    ]);
    $_SESSION['success_message'] = 'Bülten aboneliğiniz başarıyla iptal edildi.';
}

header('Location: /');
exit;
