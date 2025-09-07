<?php

$db = App::resolve('database');
$pageTitle = 'Ana Sayfa';

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