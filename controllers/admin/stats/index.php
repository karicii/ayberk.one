<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

// Temel istatistikleri çek
$totalPosts = $db->query('SELECT COUNT(*) as total FROM posts')->find()['total'];
$totalViews = $db->query('SELECT SUM(view_count) as total FROM posts')->find()['total'];
$totalMessages = $db->query('SELECT COUNT(*) as total FROM messages')->find()['total'];

// En popüler 5 yazıyı çek
$popularPosts = $db->query('SELECT title, slug, view_count FROM posts ORDER BY view_count DESC LIMIT 5')->get();

// Son 5 mesajı çek
$recentMessages = $db->query('SELECT id, name, subject, created_at FROM messages ORDER BY created_at DESC LIMIT 5')->get();


$pageTitle = 'İstatistikler';
require(BASE_PATH . '/templates/admin/stats/index.php');