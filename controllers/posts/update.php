<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');

// DÜZELTME: Formdan gelen veriyi güvenli bir şekilde al.
$title = $_POST['title'] ?? null;
$body = $_POST['body'] ?? null;
$currentUserId = 1; // Session'dan gelen gerçek kullanıcı ID'si ile değiştirilecek.

// Önce yazının varlığını ve sahipliğini kontrol et.
$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

if (!$post) {
    http_response_code(403);
    echo 'Yetkisiz erişim.';
    die();
}

// Doğrulama
$errors = [];
if (empty($title)) {
    $errors[] = 'Başlık zorunludur.';
}
if (empty($body)) {
    $errors[] = 'İçerik zorunludur.';
}

// Hata yoksa veritabanını güncelle
if (empty($errors)) {
    $db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id', [
        ':id' => $id,
        ':title' => $title,
        ':body' => $body
    ]);
    
    // Güncellemeden sonra admin paneline yönlendir.
    header('Location: /admin');
    exit();
}

// Hata varsa, hatalarla birlikte formu tekrar göster
$pageTitle = 'Yazıyı Düzenle';
view('posts/edit.php', [
    'pageTitle' => $pageTitle,
    'post' => $post,
    'errors' => $errors
]);