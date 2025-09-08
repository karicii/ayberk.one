<?php

authorize();

$db = App::resolve('database');

$errors = [];
if (empty($_POST['title'])) {
    $errors[] = 'Başlık alanı zorunludur.';
}
if (empty($_POST['body'])) {
    $errors[] = 'İçerik alanı zorunlurur.';
}

if (empty($errors)) {
    $slug = slugify($_POST['title']);

    // DÜZELTME: user_id'yi sabit '1' yerine, session'dan al.
    $db->query('INSERT INTO posts(title, slug, body, user_id) VALUES(:title, :slug, :body, :user_id)', [
        ':title' => $_POST['title'],
        ':slug' => $slug,
        ':body' => $_POST['body'],
        ':user_id' => $_SESSION['user']['id'] 
    ]);

    // Kayıttan sonra anasayfaya değil, admin paneline yönlendirelim.
    header('Location: /admin');
    exit();
}

$pageTitle = 'Yeni Yazı Oluştur';
view('posts/create.php', [
    'pageTitle' => $pageTitle,
    'errors' => $errors
]);