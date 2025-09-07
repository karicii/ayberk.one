<?php

$router = new Router();

// ... diğer rotalar ...

// Admin Rotaları
$router->get('/admin/posts/create', 'posts/create.php');
$router->post('/admin/posts', 'posts/store.php');
$router->get('/admin/posts/edit/{id}', 'posts/edit.php');   // Düzenleme formunu göster
$router->patch('/admin/posts/{id}', 'posts/update.php'); // Güncelleme işlemini yap
$router->delete('/admin/posts/{id}', 'posts/destroy.php'); // Silme işlemini yap (URI güncellendi)
// AUTH ROTALARI
$router->get('/login', 'auth/create.php');
$router->post('/login', 'auth/store.php');
$router->post('/logout', 'auth/destroy.php');
return $router;