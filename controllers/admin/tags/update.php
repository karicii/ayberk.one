<?php

authorize();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'PATCH') {
    redirect('/admin/tags');
}

$db = App::resolve('database');
global $router;
$id = $router->params('id');

$tag = $db->query('SELECT * FROM tags WHERE id = :id', [':id' => $id])->find();

if (!$tag) {
    $_SESSION['error'] = 'Etiket bulunamadı.';
    redirect('/admin/tags');
}

// Validasyon
$errors = [];

if (empty($_POST['name'])) {
    $errors[] = 'Etiket adı gereklidir.';
}

if (empty($_POST['slug'])) {
    $errors[] = 'Slug gereklidir.';
}

// Etiket adı kontrolü (kendisi hariç)
if (!empty($_POST['name'])) {
    $existing = $db->query('SELECT COUNT(*) as count FROM tags WHERE name = :name AND id != :id', [
        ':name' => $_POST['name'],
        ':id' => $id
    ])->find();
    
    if ($existing['count'] > 0) {
        $errors[] = 'Bu etiket adı zaten kullanılıyor.';
    }
}

// Slug kontrolü (kendisi hariç)
if (!empty($_POST['slug'])) {
    $existing = $db->query('SELECT COUNT(*) as count FROM tags WHERE slug = :slug AND id != :id', [
        ':slug' => $_POST['slug'],
        ':id' => $id
    ])->find();
    
    if ($existing['count'] > 0) {
        $errors[] = 'Bu slug zaten kullanılıyor.';
    }
}

if (!empty($errors)) {
    $_SESSION['error'] = implode(' ', $errors);
    redirect('/admin/tags/edit/' . $id);
}

// Etiket güncelle
$db->query('
    UPDATE tags 
    SET name = :name, 
        slug = :slug, 
        description = :description
    WHERE id = :id
', [
    ':id' => $id,
    ':name' => $_POST['name'],
    ':slug' => $_POST['slug'],
    ':description' => $_POST['description'] ?? null
]);

$_SESSION['success'] = 'Etiket başarıyla güncellendi!';
redirect('/admin/tags');
