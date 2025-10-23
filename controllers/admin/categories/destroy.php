<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');

// CSRF koruması
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token validation failed');
}

// Kategoriyi bul
$category = $db->query('SELECT * FROM categories WHERE id = :id', [
    ':id' => $id
])->find();

if (!$category) {
    http_response_code(404);
    die('Kategori bulunamadı.');
}

// Kategoriye bağlı yazı sayısını kontrol et
$postCount = $db->query('SELECT COUNT(*) as count FROM post_categories WHERE category_id = :id', [
    ':id' => $id
])->find();

if ($postCount['count'] > 0) {
    $_SESSION['error'] = 'Bu kategoriye bağlı ' . $postCount['count'] . ' yazı var. Önce bu yazıları silmeniz veya başka kategoriye taşımanız gerekiyor.';
    header('Location: /admin/categories');
    exit;
}

// Kategoriyi sil
$db->query('DELETE FROM categories WHERE id = :id', [
    ':id' => $id
]);

// Başarı mesajı
$_SESSION['success'] = 'Kategori başarıyla silindi!';

// Kategori listesine yönlendir
header('Location: /admin/categories');
exit;
