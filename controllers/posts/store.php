<?php

// Basit doğrulama
$errors = [];
if (empty($_POST['title'])) {
    $errors[] = 'Başlık alanı zorunludur.';
}

if (empty($_POST['body'])) {
    $errors[] = 'İçerik alanı zorunlurur.';
}

// Hata yoksa veritabanına kaydet
if (empty($errors)) {
    $db->query('INSERT INTO posts(title, body, user_id) VALUES(:title, :body, :user_id)', [
        ':title' => $_POST['title'],
        ':body' => $_POST['body'],
        ':user_id' => 1 // Şimdilik kullanıcı ID'sini sabit olarak 1 veriyoruz. Login sistemi gelince dinamik olacak.
    ]);

    // Kayıttan sonra anasayfaya yönlendir
    header('Location: /');
    exit();
}

// Hata varsa, hatalarla birlikte formu tekrar göster
$pageTitle = 'Yeni Yazı Oluştur';
view('posts/create.php', [
    'pageTitle' => $pageTitle,
    'errors' => $errors
]);