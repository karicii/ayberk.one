<?php 

authorize();

$db = App::resolve('database');

$posts = $db->query('SELECT * FROM posts ORDER BY created_at DESC')->findAll();

$pageTitle = "Admin Paneli";

view('admin/index.php', [
    'pageTitle' => $pageTitle,
    'posts' => $posts
]); 


