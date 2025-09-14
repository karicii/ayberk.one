<?php

$db = App::resolve('database');
$pageTitle = 'Ana Sayfa';
$pageDescription = 'Ayberk A. - Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine kişisel blog ve proje portfolyosu.';

$latestPosts = $db->query('SELECT title, slug, image_path FROM posts ORDER BY created_at DESC LIMIT 5')->findAll();

view('home.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'latestPosts' => $latestPosts
]);