<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');

$message = $db->query('SELECT * FROM messages WHERE id = :id', [':id' => $id])->find();

if (!$message) {
    http_response_code(404);
    require BASE_PATH . "/templates/404.php";
    die();
}

view('admin/messages/show.php', [
    'title' => 'Mesaj Detayı',
    'message' => $message
]);