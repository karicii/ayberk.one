<?php

$db = App::resolve('database');
$query = trim($_GET['q'] ?? '');
$results = [];
$searchPerformed = !empty($query);
$tooShort = false;

if ($searchPerformed) {
    // Minimum 3 karakter kontrolü
    if (mb_strlen($query) < 3) {
        $tooShort = true;
        $searchPerformed = false;
    } else {
        $searchTerm = '%' . $query . '%';
    
        // Sadece başlık ve içerikte ara - daha az agresif
        $sql = "SELECT DISTINCT p.*, 
                       c.name as category_name,
                       c.slug as category_slug,
                       GROUP_CONCAT(DISTINCT t.name SEPARATOR ', ') as tags,
                       SUBSTRING(p.body, 1, 150) as excerpt
                FROM posts p
                LEFT JOIN post_categories pc ON p.id = pc.post_id
                LEFT JOIN categories c ON pc.category_id = c.id
                LEFT JOIN post_tags pt ON p.id = pt.post_id
                LEFT JOIN tags t ON pt.tag_id = t.id
                WHERE (p.title LIKE :search_term OR p.body LIKE :search_term2)
                GROUP BY p.id
                ORDER BY 
                    CASE 
                        WHEN p.title LIKE :exact_match THEN 1
                        WHEN p.title LIKE :search_term3 THEN 2
                        ELSE 3
                    END,
                    p.created_at DESC
                LIMIT 20";
        
        $results = $db->query($sql, [
            'exact_match' => $query,
            'search_term' => $searchTerm,
            'search_term2' => $searchTerm,
            'search_term3' => $searchTerm,
        ])->findAll();
    }
}

$pageTitle = $searchPerformed 
    ? "'" . htmlspecialchars($query) . "' için Arama Sonuçları" 
    : "Arama";

$pageDescription = $searchPerformed 
    ? count($results) . " sonuç bulundu" 
    : "Blog yazılarında ara";

// Sidebar'ı devre dışı bırak
$hideSidebar = true;

require BASE_PATH . '/templates/search/index.php';
