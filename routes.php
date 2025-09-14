<?php

$router = new Router();

// Ziyaretçi Rotaları
$router->get('/', 'home.php');
$router->get('/posts/{slug}', 'posts/show.php');
$router->get('/sitemap.xml', 'sitemap.php');
$router->get('/contact', 'contact/create.php');
$router->post('/contact', 'contact/store.php');

// Admin Rotaları
$router->get('/admin', 'admin/index.php'); 
$router->get('/admin/posts/create', 'posts/create.php');
$router->post('/admin/posts', 'posts/store.php');
$router->get('/admin/posts/edit/{id}', 'posts/edit.php');
$router->patch('/admin/posts/{id}', 'posts/update.php');
$router->delete('/admin/posts/{id}', 'posts/destroy.php');
$router->get('/admin/messages', 'admin/messages/index.php')->only('auth');
$router->post('/admin/messages/delete', 'admin/messages/destroy.php')->only('auth');

// AUTH ROTALARI
$router->get('/login', 'auth/create.php');
$router->post('/login', 'auth/store.php');
$router->post('/logout', 'auth/destroy.php');


return $router;