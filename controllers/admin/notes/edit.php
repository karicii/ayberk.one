<?php

authorize();

$db = App::resolve('database');
$router = App::resolve('router');

$id = $router->params('id');

$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $id])->find();

if (!$note) {
    $_SESSION['error_message'] = 'Not bulunamadı.';
    header('Location: /admin/notes');
    exit;
}

$pageTitle = 'Notu Düzenle';

require BASE_PATH . '/templates/admin/notes/edit.php';
