<?php

authorize();
verify_csrf_token();

$db = App::resolve('database');
$id = $_POST['id'] ?? 0;

$db->query('UPDATE subscribers SET status = :status, subscribed_at = NOW(), unsubscribed_at = NULL WHERE id = :id', [
    'status' => 'active',
    'id' => $id
]);

$_SESSION['success_message'] = 'Abone başarıyla yeniden aktif edildi.';
header('Location: /admin/newsletter');
exit;
