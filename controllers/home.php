<?php

$db = App::resolve('database');
$pageTitle = 'Ana Sayfa';
$pageDescription = 'Ayberk A. - Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine kişisel blog ve proje portfolyosu.';

// Şimdilik sahte veri kullanalım.
$latestPosts = [
    ['title' => 'İlk Yazım', 'id' => 1],
    ['title' => 'İkinci Projem', 'id' => 2],
    ['title' => 'Üçüncü Manifesto', 'id' => 3]
];

view('home.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'latestPosts' => $latestPosts
]);