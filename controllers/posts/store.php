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
    $db->query('INSERT INTO posts(title, body, user_id) VALUES(:title, :body, :user_id)', [
        ':title' => $_POST['title'],
        ':body' => $_POST['body'],
        ':user_id' => 1
    ]);

    header('Location: /');
    exit();
}

$pageTitle = 'Yeni Yazı Oluştur';
view('posts/create.php', [
    'pageTitle' => $pageTitle,
    'errors' => $errors
]);