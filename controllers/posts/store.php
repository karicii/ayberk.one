<?php
verify_csrf_token();
authorize();

$db = App::resolve('database');

require_once BASE_PATH . '/core/ReadingTime.php';

$errors = [];
if (empty($_POST['title'])) {
    $errors[] = 'Başlık alanı zorunludur.';
}
// Diğer doğrulamalar buraya eklenebilir...

$imagePath = null;
if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array($_FILES['post_image']['type'], $allowedTypes)) {
        $uploadDir = BASE_PATH . '/public/uploads/';
        $fileName = uniqid() . '-' . basename($_FILES['post_image']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
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
    $readingTime = ReadingTime::calculate($_POST['body']);

    // 1. Yazıyı veritabanına ekle
    $db->query(
        'INSERT INTO posts(title, slug, body, user_id, image_path, reading_time) VALUES(:title, :slug, :body, :user_id, :image_path, :reading_time)',
        [
            ':title' => $_POST['title'],
            ':slug' => $slug,
            ':body' => $_POST['body'],
            ':user_id' => $_SESSION['user']['id'],
            ':image_path' => $imagePath,
            ':reading_time' => $readingTime
        ]
    );

    // 2. Eklenen son yazının ID'sini al
    $lastPostId = $db->connection->lastInsertId();

    // 3. Seçilen kategorileri post_categories tablosuna ekle
    if (!empty($_POST['categories'])) {
        foreach ($_POST['categories'] as $categoryId) {
            $db->query(
                'INSERT INTO post_categories(post_id, category_id) VALUES(:post_id, :category_id)',
                [
                    ':post_id' => $lastPostId,
                    ':category_id' => $categoryId
                ]
            );
        }
    }

    header('Location: /admin');
    exit();
}

// Hata varsa formu tekrar göster
$categories = $db->query('SELECT * FROM categories ORDER BY name ASC')->findAll();
$pageTitle = 'Yeni Yazı Oluştur';
view('posts/create.php', [
    'pageTitle' => $pageTitle,
    'categories' => $categories,
    'errors' => $errors
]);