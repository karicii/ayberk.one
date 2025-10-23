<?php

authorize();

$db = App::resolve('database');

// CSRF koruması
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token validation failed');
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

// Slug benzersizlik kontrolü
if (empty($errors['slug'])) {
    $existingCategory = $db->query('SELECT id FROM categories WHERE slug = :slug', [
        ':slug' => $slug
    ])->find();
    
    if ($existingCategory) {
        $errors['slug'] = 'Bu slug zaten kullanılıyor.';
    }
}

// İsim benzersizlik kontrolü
if (empty($errors['name'])) {
    $existingCategory = $db->query('SELECT id FROM categories WHERE name = :name', [
        ':name' => $name
    ])->find();
    
    if ($existingCategory) {
        $errors['name'] = 'Bu kategori adı zaten kullanılıyor.';
    }
}

// Hata varsa geri dön
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header('Location: /admin/categories/create');
    exit;
}

// Kategoriyi veritabanına ekle
$db->query('INSERT INTO categories (name, slug) VALUES (:name, :slug)', [
    ':name' => $name,
    ':slug' => $slug
]);

// Başarı mesajı
$_SESSION['success'] = 'Kategori başarıyla eklendi!';

// Kategori listesine yönlendir
header('Location: /admin/categories');
exit;
