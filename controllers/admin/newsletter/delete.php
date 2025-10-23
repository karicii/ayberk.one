<?php

authorize();
verify_csrf_token();

$db = App::resolve('database');
$id = $_POST['id'] ?? 0;

$db->query('DELETE FROM subscribers WHERE id = :id', ['id' => $id]);

$_SESSION['success_message'] = 'Abone başarıyla silindi.';
header('Location: /admin/newsletter');
exit;
