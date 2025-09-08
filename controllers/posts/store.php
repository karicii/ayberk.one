<?php

authorize();

$db = App::resolve('database');

$errors = [];
if (empty($_POST['title'])) {
    $errors[] = 'Başlık alanı zorunludur.';
}

$imagePath = null;
// EĞER BİR GÖRSEL YÜKLENDİYSE BU BLOK ÇALIŞACAK
if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array($_FILES['post_image']['type'], $allowedTypes)) {
        $uploadDir = BASE_PATH . '/public/uploads/';
        // Dosya adını benzersiz yap
        $fileName = uniqid() . '-' . basename($_FILES['post_image']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
            // Başarılı olursa, veritabanına kaydedilecek yolu ayarla
            $imagePath = '/uploads/' . $fileName;
        } else {
            $errors[] = 'Görsel yüklenirken bir hata oluştu.';
        }
    } else {
        $errors[] = 'Geçersiz dosya türü. Sadece JPG, PNG, GIF, WebP kabul edilir.';
    }
}

if (empty($errors)) {
    $slug = slugify($_POST['title']);

    $db->query(
        'INSERT INTO posts(title, slug, body, user_id, image_path) VALUES(:title, :slug, :body, :user_id, :image_path)',
        [
            ':title' => $_POST['title'],
            ':slug' => $slug,
            ':body' => $_POST['body'],
            ':user_id' => $_SESSION['user']['id'],
            ':image_path' => $imagePath // Görsel yolunu veritabanına ekle
        ]
    );

    header('Location: /admin');
    exit();
}

// Hata varsa formu tekrar göster
$pageTitle = 'Yeni Yazı Oluştur';
view('posts/create.php', [
    'pageTitle' => $pageTitle,
    'errors' => $errors
]);