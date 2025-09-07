<?php

global $router; // Globals kullanmak ideal değil ama şimdilik en basit yol.
$id = $router->params('id');

$currentUserId = 1; // Login sistemi gelene kadar sabit.

$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

// Yazı bulunamazsa veya kullanıcıya ait değilse 403 (Forbidden) hatası ver.
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