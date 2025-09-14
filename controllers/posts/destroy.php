<?php
verify_csrf_token();
authorize();

$db = App::resolve('database');
global $router; 
$id = $router->params('id');
$currentUserId = $_SESSION['user']['id']; // <-- DEĞİŞİKLİK BURADA

$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

if ($post) {
    $db->query('DELETE FROM posts WHERE id = :id', [
        ':id' => $id
    ]);
}

header('Location: /admin'); 
exit();