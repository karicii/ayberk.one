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

// 5. Yazıya ait etiketleri çek
$tags = $db->query(
    'SELECT t.name, t.slug FROM tags t
     JOIN post_tags pt ON t.id = pt.tag_id
     WHERE pt.post_id = :post_id
     ORDER BY t.name ASC',
    [':post_id' => $post['id']]
)->findAll();

// 6. SEO ve sayfa için gerekli değişkenleri hazırla
$pageTitle = $post['title'];
$pageDescription = substr(strip_tags($post['body']), 0, 155) . '...';

// SEO Keywords (etiketlerden oluştur)
$keywords = !empty($tags) ? array_column($tags, 'name') : [];

$jsonLdSchema = generate_json_ld($post, $tags);
$isPostShowPage = true; 

// 7. Tüm verileri view'e gönder
view('posts/show.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'post' => $post,
    'jsonLdSchema' => $jsonLdSchema,
    'isPostShowPage' => $isPostShowPage,
    'categories' => $categories, // Kategorileri view'e gönder
    'tags' => $tags, // Etiketleri view'e gönder
    'keywords' => $keywords // SEO keywords
]);