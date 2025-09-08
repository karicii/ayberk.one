<?php

$router = new Router();

// Ziyaretçi Rotaları
$router->get('/', 'home.php');
$router->get('/posts/{slug}', 'posts/show.php');
$router->get('/sitemap.xml', 'sitemap.php');

// Admin Rotaları
$router->get('/admin', 'admin/index.php'); // <-- BU SATIR EKLENMELİ
$router->get('/admin/posts/create', 'posts/create.php');
$router->post('/admin/posts', 'posts/store.php');
$router->get('/admin/posts/edit/{id}', 'posts/edit.php');
$router->patch('/admin/posts/{id}', 'posts/update.php');
$router->delete('/admin/posts/{id}', 'posts/destroy.php');

// AUTH ROTALARI
$router->get('/login', 'auth/create.php');
$router->post('/login', 'auth/store.php');
$router->post('/logout', 'auth/destroy.php');

return $router;