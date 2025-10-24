<?php

authorize();
verify_csrf_token();

$db = App::resolve('database');

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$category = trim($_POST['category'] ?? '') ?: null;
$is_published = isset($_POST['is_published']) ? 1 : 0;

if (empty($title) || empty($content)) {
    $_SESSION['error_message'] = 'Başlık ve içerik zorunludur.';
    header('Location: /admin/notes/create');
    exit;
}

$slug = slugify($title);

// Slug benzersiz mi kontrol et
$exists = $db->query('SELECT id FROM notes WHERE slug = :slug', ['slug' => $slug])->find();
if ($exists) {
    $slug = $slug . '-' . time();
}

$db->query('INSERT INTO notes (title, slug, content, category, is_published) VALUES (:title, :slug, :content, :category, :is_published)', [
    'title' => $title,
    'slug' => $slug,
    'content' => $content,
    'category' => $category,
    'is_published' => $is_published
]);

$_SESSION['success_message'] = 'Not başarıyla eklendi.';
header('Location: /admin/notes');
exit;
