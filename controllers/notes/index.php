<?php

$db = App::resolve('database');

// Kategori filtresi
$category = $_GET['category'] ?? null;

// Notları çek (son eklenenler önce)
if ($category) {
    $notes = $db->query('SELECT * FROM notes WHERE is_published = 1 AND category = :category ORDER BY created_at DESC', [
        'category' => $category
    ])->findAll();
    
    $pageTitle = ucfirst($category) . ' Notları';
} else {
    $notes = $db->query('SELECT * FROM notes WHERE is_published = 1 ORDER BY created_at DESC')->findAll();
    $pageTitle = 'Notlar';
}

// Kategorileri al
$categories = $db->query('SELECT DISTINCT category, COUNT(*) as count FROM notes WHERE is_published = 1 AND category IS NOT NULL GROUP BY category ORDER BY category')->findAll();

$pageDescription = 'Kısa notlar ve bugün öğrendiklerim';

require BASE_PATH . '/templates/notes/index.php';
