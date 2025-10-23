<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');

// Kategoriyi bul
$category = $db->query('SELECT * FROM categories WHERE id = :id', [
    ':id' => $id
])->find();

// Kategori bulunamazsa 404
if (!$category) {
    http_response_code(404);
    require BASE_PATH . "/templates/404.php";
    die();
}

$pageTitle = "Kategori Düzenle";

view('admin/categories/edit.php', [
    'pageTitle' => $pageTitle,
    'category' => $category
]);
