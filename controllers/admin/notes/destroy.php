<?php

authorize();
verify_csrf_token();

$db = App::resolve('database');
$router = App::resolve('router');

$id = $router->params('id');

$db->query('DELETE FROM notes WHERE id = :id', ['id' => $id]);

$_SESSION['success_message'] = 'Not başarıyla silindi.';
header('Location: /admin/notes');
exit;
