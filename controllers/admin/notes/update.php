<?php

authorize();
verify_csrf_token();

$db = App::resolve('database');
$router = App::resolve('router');

$id = $router->params('id');
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$category = trim($_POST['category'] ?? '') ?: null;
$is_published = isset($_POST['is_published']) ? 1 : 0;

if (empty($title) || empty($content)) {
    $_SESSION['error_message'] = 'Başlık ve içerik zorunludur.';
    header('Location: /admin/notes/edit/' . $id);
    exit;
}

$slug = slugify($title);

// Slug benzersiz mi kontrol et (kendi kaydı hariç)
$exists = $db->query('SELECT id FROM notes WHERE slug = :slug AND id != :id', [
    'slug' => $slug,
    'id' => $id
])->find();

if ($exists) {
    $slug = $slug . '-' . time();
}

$db->query('UPDATE notes SET title = :title, slug = :slug, content = :content, category = :category, is_published = :is_published WHERE id = :id', [
    'title' => $title,
    'slug' => $slug,
    'content' => $content,
    'category' => $category,
    'is_published' => $is_published,
    'id' => $id
]);

$_SESSION['success_message' ] = 'Not başarıyla güncellendi.';
header('Location: /admin/notes');
exit;
