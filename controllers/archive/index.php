<?php

$db = App::resolve('database');

// Yıl ve ay parametrelerini al (opsiyonel)
global $router;
$year = $router->params('year') ?? null;
$month = $router->params('month') ?? null;

// Yıl/ay bazında yazıları çek
if ($year && $month) {
    // Belirli ay için yazılar
    $posts = $db->query(
        'SELECT * FROM posts 
         WHERE YEAR(created_at) = :year 
         AND MONTH(created_at) = :month
         ORDER BY created_at DESC',
        [':year' => $year, ':month' => $month]
    )->findAll();
    
    $pageTitle = date('F Y', mktime(0, 0, 0, $month, 1, $year)) . ' Arşivi';
} elseif ($year) {
    // Belirli yıl için yazılar
    $posts = $db->query(
        'SELECT * FROM posts 
         WHERE YEAR(created_at) = :year
         ORDER BY created_at DESC',
        [':year' => $year]
    )->findAll();
    
    $pageTitle = $year . ' Yılı Arşivi';
} else {
    // Tüm yazılar yıl/ay gruplu
    $posts = $db->query(
        'SELECT * FROM posts 
         ORDER BY created_at DESC'
    )->findAll();
    
    $pageTitle = 'Tüm Arşiv';
}

// Arşiv istatistikleri - Yıl/Ay bazında grupla
$archive = $db->query(
    'SELECT 
        YEAR(created_at) as year,
        MONTH(created_at) as month,
        COUNT(*) as count,
        DATE_FORMAT(created_at, "%Y-%m") as yearmonth
     FROM posts
     GROUP BY YEAR(created_at), MONTH(created_at)
     ORDER BY created_at DESC'
)->findAll();

return view('archive/index.php', [
    'posts' => $posts,
    'archive' => $archive,
    'year' => $year,
    'month' => $month,
    'title' => $pageTitle
]);
