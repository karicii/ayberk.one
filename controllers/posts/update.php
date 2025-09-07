<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');

// Formdan gelen veriyi ve ID'yi al.
$title = $_POST['title'];
$body = $_POST['body'];
$currentUserId = 1;

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
    
    header('Location: /'); // Anasayfaya yönlendir
    exit();
}

// Hata varsa, hatalarla birlikte formu tekrar göster
$pageTitle = 'Yazıyı Düzenle';
view('posts/edit.php', [
    'pageTitle' => $pageTitle,
    'post' => $post, // Hata durumunda eski post verilerini yolluyoruz.
    'errors' => $errors
]);