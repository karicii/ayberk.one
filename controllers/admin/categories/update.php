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

$name = trim($_POST['name'] ?? '');
$slug = trim($_POST['slug'] ?? '');

$errors = [];

// Validasyon
if (empty($name)) {
    $errors['name'] = 'Kategori adı zorunludur.';
}

if (empty($slug)) {
    $errors['slug'] = 'Slug zorunludur.';
} else {
    // Slug kontrolü - sadece küçük harf, rakam ve tire içermeli
    if (!preg_match('/^[a-z0-9-]+$/', $slug)) {
        $errors['slug'] = 'Slug sadece küçük harf, rakam ve tire içermelidir.';
    }
}

// Slug benzersizlik kontrolü (kendi ID'si hariç)
if (empty($errors['slug'])) {
    $existingCategory = $db->query('SELECT id FROM categories WHERE slug = :slug AND id != :id', [
        ':slug' => $slug,
        ':id' => $id
    ])->find();
    
    if ($existingCategory) {
        $errors['slug'] = 'Bu slug zaten kullanılıyor.';
    }
}

// İsim benzersizlik kontrolü (kendi ID'si hariç)
if (empty($errors['name'])) {
    $existingCategory = $db->query('SELECT id FROM categories WHERE name = :name AND id != :id', [
        ':name' => $name,
        ':id' => $id
    ])->find();
    
    if ($existingCategory) {
        $errors['name'] = 'Bu kategori adı zaten kullanılıyor.';
    }
}

// Hata varsa geri dön
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header('Location: /admin/categories/edit/' . $id);
    exit;
}

// Kategoriyi güncelle
$db->query('UPDATE categories SET name = :name, slug = :slug WHERE id = :id', [
    ':name' => $name,
    ':slug' => $slug,
    ':id' => $id
]);

// Başarı mesajı
$_SESSION['success'] = 'Kategori başarıyla güncellendi!';

// Kategori listesine yönlendir
header('Location: /admin/categories');
exit;
