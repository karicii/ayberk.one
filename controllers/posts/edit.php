<?php
authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');
$currentUserId = $_SESSION['user']['id'];

// Düzenlenecek yazıyı çek
$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

if (!$post) {
    http_response_code(403);
    echo 'Bu işlemi yapmaya yetkiniz yok.';
    die();
}

// Tüm kategorileri çek
$categories = $db->query('SELECT * FROM categories ORDER BY name ASC')->findAll();

// Tüm etiketleri çek
$tags = $db->query('SELECT * FROM tags ORDER BY name ASC')->findAll();

// Bu yazıya ait olan kategorilerin ID'lerini bir dizi olarak çek
$postCategoryIds = $db->query(
    'SELECT category_id FROM post_categories WHERE post_id = :post_id',
    [':post_id' => $id]
)->findAll(PDO::FETCH_COLUMN); // Sadece category_id sütununu al

// Bu yazıya ait olan etiketlerin ID'lerini bir dizi olarak çek
$postTagIds = $db->query(
    'SELECT tag_id FROM post_tags WHERE post_id = :post_id',
    [':post_id' => $id]
)->findAll(PDO::FETCH_COLUMN);

// Bu yazıya ait etiket isimlerini al (input için)
$postTags = $db->query(
    'SELECT t.name FROM tags t
     JOIN post_tags pt ON t.id = pt.tag_id
     WHERE pt.post_id = :post_id',
    [':post_id' => $id]
)->findAll();
$postTagsString = implode(', ', array_column($postTags, 'name'));


$pageTitle = 'Yazıyı Düzenle';

view('posts/edit.php', [
    'pageTitle' => $pageTitle,
    'post' => $post,
    'categories' => $categories, // Tüm kategori listesini view'e gönder
    'postCategoryIds' => $postCategoryIds, // Yazıya ait kategori ID'lerini view'e gönder
    'tags' => $tags, // Tüm etiket listesini view'e gönder
    'postTagIds' => $postTagIds, // Yazıya ait etiket ID'lerini view'e gönder
    'postTagsString' => $postTagsString // Etiket isimleri string olarak
]);