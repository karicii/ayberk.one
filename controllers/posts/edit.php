<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');
$currentUserId = 1;

$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

if (!$post) {
    http_response_code(403);
    echo 'Bu işlemi yapmaya yetkiniz yok.';
    die();
}

$pageTitle = 'Yazıyı Düzenle';

view('posts/edit.php', [
    'pageTitle' => $pageTitle,
    'post' => $post
]);