<?php

$db = App::resolve('database');
global $router;
$slug = $router->params('slug');

// 1. Slug'a göre kategoriyi bul
$category = $db->query('SELECT * FROM categories WHERE slug = :slug', [':slug' => $slug])->find();

// Kategori bulunamazsa 404 hatası ver
if (!$category) {
    http_response_code(404);
    require BASE_PATH . "/templates/404.php";
    die();
}

// 2. Kategoriye ait tüm yazıları çek
// (post_categories tablosunu kullanarak posts tablosu ile birleştirme yapıyoruz)
$posts = $db->query(
    'SELECT p.* FROM posts p 
     JOIN post_categories pc ON p.id = pc.post_id 
     WHERE pc.category_id = :category_id 
     ORDER BY p.created_at DESC',
    [':category_id' => $category['id']]
)->findAll();

// Sayfa başlığı ve açıklaması
$pageTitle = $category['name'] . ' Kategorisi';
$pageDescription = $category['name'] . ' kategorisindeki yazılar.';

// Verileri view'e gönder
view('categories/show.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'category' => $category,
    'posts' => $posts
]);