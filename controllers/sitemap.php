<?php

$db = App::resolve('database');
$config = require BASE_PATH . '/core/config.php';
$baseUrl = $config['app']['url'];

// Veritabanından tüm yazıların slug ve güncelleme tarihlerini çek.
// Şimdilik created_at kullanıyoruz, updated_at eklenince o kullanılmalı.
$posts = $db->query('SELECT slug, created_at FROM posts ORDER BY created_at DESC')->findAll();

// Tarayıcıya bunun bir HTML değil, XML dosyası olduğunu söylüyoruz.
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// 1. Statik Sayfalar (Anasayfa vb.)
echo '  <url>' . PHP_EOL;
echo '    <loc>' . $baseUrl . '/</loc>' . PHP_EOL;
echo '    <lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL; // Bugünkü tarih
echo '    <priority>1.0</priority>' . PHP_EOL;
echo '  </url>' . PHP_EOL;

// 2. Dinamik Sayfalar (Yazılar)
foreach ($posts as $post) {
    echo '  <url>' . PHP_EOL;
    echo '    <loc>' . $baseUrl . '/posts/' . $post['slug'] . '</loc>' . PHP_EOL;
    // Tarihi W3C formatına (YYYY-MM-DD) çevir
    echo '    <lastmod>' . date('Y-m-d', strtotime($post['created_at'])) . '</lastmod>' . PHP_EOL;
    echo '    <priority>0.8</priority>' . PHP_EOL;
    echo '  </url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

exit(); // Başka hiçbir şeyin çalışmadığından emin ol