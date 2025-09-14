<?php
verify_csrf_token();
authorize();

$db = App::resolve('database');

// ReadingTime sınıfını dahil et
require_once BASE_PATH . '/core/ReadingTime.php';
global $router;
$id = $router->params('id');
$currentUserId = $_SESSION['user']['id'];

// Önce güncellenecek yazıyı bul
$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

if (!$post) {
    // Yazı bulunamazsa veya kullanıcıya ait değilse yetkisiz erişim hatası ver
    http_response_code(403);
    die('Yetkisiz erişim.');
}

$title = $_POST['title'] ?? null;
$body = $_POST['body'] ?? null;
$errors = [];

// Form doğrulama
if (empty($title)) $errors[] = 'Başlık zorunludur.';

// Görsel Yükleme Mantığı (Sadece yeni bir görsel seçildiyse çalışır)
$imagePath = $post['image_path']; // Varsayılan olarak mevcut görseli koru
if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
    // ... (store.php'deki ile aynı görsel yükleme ve doğrulama mantığı) ...
    $uploadDir = BASE_PATH . '/public/uploads/';
    $fileName = uniqid() . '-' . basename($_FILES['post_image']['name']);
    $targetFile = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
        // Yeni görsel başarıyla yüklendiyse, eski görseli sil (isteğe bağlı ama önerilir)
        if ($imagePath && file_exists(BASE_PATH . '/public' . $imagePath)) {
            unlink(BASE_PATH . '/public' . $imagePath);
        }
        $imagePath = '/uploads/' . $fileName; // Veritabanı için yeni yolu ayarla
    } else {
        $errors[] = 'Yeni görsel yüklenirken bir hata oluştu.';
    }
}

if (empty($errors)) {
    // Okuma süresini hesapla
    $readingTime = ReadingTime::calculate($body);
    
    $db->query(
        'UPDATE posts SET title = :title, body = :body, image_path = :image_path, reading_time = :reading_time WHERE id = :id',
        [
            ':id' => $id,
            ':title' => $title,
            ':body' => $body,
            ':image_path' => $imagePath, // Yeni veya mevcut görsel yolunu güncelle
            ':reading_time' => $readingTime
        ]
    );
    
    header('Location: /admin');
    exit();
}

// Hata varsa formu tekrar göster
$pageTitle = 'Yazıyı Düzenle';
view('posts/edit.php', [
    'pageTitle' => $pageTitle,
    'post' => $post,
    'errors' => $errors
]);