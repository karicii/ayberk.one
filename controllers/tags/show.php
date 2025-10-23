<?php

$db = App::resolve('database');
global $router;
$slug = $router->params('slug');

// Slug'a göre etiketi bul
$tag = $db->query('SELECT * FROM tags WHERE slug = :slug', [':slug' => $slug])->find();

if (!$tag) {
    http_response_code(404);
    return view('errors/404.php', ['title' => 'Etiket Bulunamadı']);
}

// Etiketle ilişkili yazıları getir
$posts = $db->query('
    SELECT p.* 
    FROM posts p
    INNER JOIN post_tags pt ON p.id = pt.post_id
    WHERE pt.tag_id = :tag_id
    ORDER BY p.created_at DESC
', [':tag_id' => $tag['id']])->findAll();

return view('tags/show.php', [
    'tag' => $tag,
    'posts' => $posts,
    'title' => $tag['name'] . ' Etiketli Yazılar'
]);
