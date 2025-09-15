<?php

$db = App::resolve('database');
global $router;
$slug = $router->params('slug');

$post = $db->query('SELECT * FROM posts WHERE slug = :slug', [':slug' => $slug])->find();

if (!$post) {
    http_response_code(404);
    require BASE_PATH . "/templates/404.php";
    die();
}

// YENİ EKLENEN BÖLÜM BAŞLANGICI
// Yazıya ait kategorileri çek
$categories = $db->query(
    'SELECT c.name, c.slug FROM categories c
     JOIN post_categories pc ON c.id = pc.category_id
     WHERE pc.post_id = :post_id',
    [':post_id' => $post['id']]
)->findAll();
// YENİ EKLENEN BÖLÜM SONU


// SEO Meta Etiketleri
$pageTitle = $post['title'];
$pageDescription = substr(strip_tags($post['body']), 0, 155) . '...';

// SEO Yapısal Veri
$jsonLdSchema = generate_json_ld($post);

$isPostShowPage = true; 

view('posts/show.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'post' => $post,
    'jsonLdSchema' => $jsonLdSchema,
    'isPostShowPage' => $isPostShowPage,
    'categories' => $categories // Kategorileri view'e gönder
]);