<?php 

authorize();

$db = App::resolve('database');

$categories = $db->query('SELECT * FROM categories ORDER BY name ASC')->findAll();

$pageTitle = "Kategori Yönetimi";

view('admin/categories/index.php', [
    'pageTitle' => $pageTitle,
    'categories' => $categories
]);
