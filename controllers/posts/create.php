<?php
authorize();

$db = App::resolve('database');

$categories = $db->query('SELECT * FROM categories ORDER BY name ASC')->findAll();
$tags = $db->query('SELECT * FROM tags ORDER BY name ASC')->findAll();

$pageTitle = 'Yeni Yazı Oluştur';

view('posts/create.php', [
    'pageTitle' => $pageTitle,
    'categories' => $categories, // Kategorileri view'e gönder
    'tags' => $tags // Etiketleri view'e gönder
]);