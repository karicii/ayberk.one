<?php

$db = App::resolve('database');
$query = $_GET['q'] ?? '';
$results = [];
$searchPerformed = !empty($query);

if ($searchPerformed) {
    $searchTerm = '%' . $query . '%';
    
    // Başlık, içerik, kategori ve tag'lerde ara
    $sql = "SELECT DISTINCT p.*, 
                   c.name as category_name,
                   c.slug as category_slug,
                   GROUP_CONCAT(DISTINCT t.name SEPARATOR ', ') as tags,
                   (
                       CASE 
                           WHEN p.title LIKE :title_exact THEN 100
                           WHEN p.title LIKE :title_term THEN 50
                           WHEN p.excerpt LIKE :excerpt_term THEN 30
                           WHEN p.content LIKE :content_term THEN 20
                           WHEN c.name LIKE :category_term THEN 15
                           WHEN t.name LIKE :tag_term THEN 10
                           ELSE 1
                       END
                   ) as relevance_score
            FROM posts p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN post_categories pc ON p.id = pc.post_id
            LEFT JOIN post_tags pt ON p.id = pt.post_id
            LEFT JOIN tags t ON pt.tag_id = t.id
            WHERE p.status = 'published'
            AND (
                p.title LIKE :search_term 
                OR p.content LIKE :search_term2
                OR p.excerpt LIKE :search_term3
                OR c.name LIKE :search_term4
                OR t.name LIKE :search_term5
            )
            GROUP BY p.id
            ORDER BY relevance_score DESC, p.published_at DESC
            LIMIT 50";
    
    $results = $db->query($sql, [
        'title_exact' => $query,
        'title_term' => $searchTerm,
        'excerpt_term' => $searchTerm,
        'content_term' => $searchTerm,
        'category_term' => $searchTerm,
        'tag_term' => $searchTerm,
        'search_term' => $searchTerm,
        'search_term2' => $searchTerm,
        'search_term3' => $searchTerm,
        'search_term4' => $searchTerm,
        'search_term5' => $searchTerm,
    ])->fetchAll();
}

$pageTitle = $searchPerformed 
    ? "'" . htmlspecialchars($query) . "' için Arama Sonuçları" 
    : "Arama";

$pageDescription = $searchPerformed 
    ? count($results) . " sonuç bulundu" 
    : "Blog yazılarında ara";

require BASE_PATH . '/templates/search/index.php';
