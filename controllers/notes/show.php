<?php

$db = App::resolve('database');
$router = App::resolve('router');

$slug = $router->params('slug');

$note = $db->query('SELECT * FROM notes WHERE slug = :slug AND is_published = 1', [
    'slug' => $slug
])->find();

if (!$note) {
    http_response_code(404);
    require BASE_PATH . '/templates/404.php';
    exit;
}

// Görüntülenme sayısını artır
$db->query('UPDATE notes SET view_count = view_count + 1 WHERE id = :id', [
    'id' => $note['id']
]);

$pageTitle = $note['title'];
$pageDescription = substr(strip_tags($note['content']), 0, 160);

require BASE_PATH . '/templates/notes/show.php';
