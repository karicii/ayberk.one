<?php

authorize();

$db = App::resolve('database');
global $router; 
$id = $router->params('id');
$currentUserId = 1;

$post = $db->query('SELECT * FROM posts WHERE id = :id', [':id' => $id])->find();

if ($post && $post['user_id'] === $currentUserId) {
    $db->query('DELETE FROM posts WHERE id = :id', [
        ':id' => $id
    ]);
}

header('Location: /');
exit();