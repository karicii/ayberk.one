<?php

$db = App::resolve('database');
global $router;
$slug = $router->params('slug');

// 1. Yazıyı veritabanından çek
$post = $db->query('SELECT * FROM posts WHERE slug = :slug', [':slug' => $slug])->find();

// 2. Yazı bulunamazsa 404 hatası ver
if (!$post) {
    http_response_code(404);
    require BASE_PATH . "/templates/404.php";
    die();
}

// 3. Yazı bulunduğunda görüntülenme sayısını artır
$db->query('UPDATE posts SET view_count = view_count + 1 WHERE id = :id', [
    'id' => $post['id']
]);

// 4. Yazıya ait kategorileri çek
$categories = $db->query(
    'SELECT c.name, c.slug FROM categories c
     JOIN post_categories pc ON c.id = pc.category_id
     WHERE pc.post_id = :post_id',
    [':post_id' => $post['id']]
)->findAll();

// 5. SEO ve sayfa için gerekli değişkenleri hazırla
$pageTitle = $post['title'];
$pageDescription = substr(strip_tags($post['body']), 0, 155) . '...';
$jsonLdSchema = generate_json_ld($post);
$isPostShowPage = true; 

// 6. Tüm verileri view'e gönder
view('posts/show.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'post' => $post,
    'jsonLdSchema' => $jsonLdSchema,
    'isPostShowPage' => $isPostShowPage,
    'categories' => $categories // Kategorileri view'e gönder
]);