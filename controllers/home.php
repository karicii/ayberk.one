<?php

// Bu controller'a bootstrap.php'de oluşturulan $db nesnesi otomatik olarak erişilebilir durumdadır.

$pageTitle = 'Ana Sayfa';

// Örnek: Veritabanından son 3 yazıyı çekelim.
// Henüz 'posts' tablomuz yok ama olunca sorgu böyle görünecek.
// $latestPosts = $db->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 3')->findAll();

// Şimdilik sahte veri kullanalım.
$latestPosts = [
    ['title' => 'İlk Yazım'],
    ['title' => 'İkinci Projem'],
    ['title' => 'Üçüncü Manifesto']
];

view('home.php', [
    'pageTitle' => $pageTitle,
    'latestPosts' => $latestPosts
]);