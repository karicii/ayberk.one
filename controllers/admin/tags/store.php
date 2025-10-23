<?php

authorize();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/admin/tags');
}

$db = App::resolve('database');

// Validasyon
$errors = [];

if (empty($_POST['name'])) {
    $errors[] = 'Etiket adı gereklidir.';
}

if (empty($_POST['slug'])) {
    $errors[] = 'Slug gereklidir.';
}

// Etiket adı kontrolü
if (!empty($_POST['name'])) {
    $existing = $db->query('SELECT COUNT(*) as count FROM tags WHERE name = :name', [
        ':name' => $_POST['name']
    ])->find();
    
    if ($existing['count'] > 0) {
        $errors[] = 'Bu etiket adı zaten kullanılıyor.';
    }
}

// Slug kontrolü
if (!empty($_POST['slug'])) {
    $existing = $db->query('SELECT COUNT(*) as count FROM tags WHERE slug = :slug', [
        ':slug' => $_POST['slug']
    ])->find();
    
    if ($existing['count'] > 0) {
        $errors[] = 'Bu slug zaten kullanılıyor.';
    }
}

if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);
    redirect('/admin/tags/create');
}

// Etiket oluştur
$db->query('
    INSERT INTO tags (name, slug, description) 
    VALUES (:name, :slug, :description)
', [
    ':name' => $_POST['name'],
    ':slug' => $_POST['slug'],
    ':description' => $_POST['description'] ?? null
]);

$_SESSION['success'] = 'Etiket başarıyla oluşturuldu!';
redirect('/admin/tags');
