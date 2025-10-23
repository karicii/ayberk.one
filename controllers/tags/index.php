<?php

$db = App::resolve('database');

// Tüm etiketleri ve yazı sayılarını getir
$tags = $db->query("
    SELECT t.*, 
           COUNT(pt.post_id) as post_count
    FROM tags t
    LEFT JOIN post_tags pt ON t.id = pt.tag_id
    GROUP BY t.id
    ORDER BY t.name ASC
")->findAll();

return view('tags/index.php', [
    'tags' => $tags,
    'title' => 'Tüm Etiketler'
]);
