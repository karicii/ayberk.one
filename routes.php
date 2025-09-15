<?php


$router = new Router();

// --- GENEL SAYFALAR ---
$router->get('/', 'home.php');
$router->get('/posts/{slug}', 'posts/show.php');
$router->get('/category/{slug}', 'categories/show.php');
$router->get('/sitemap.xml', 'sitemap.php');
$router->get('/contact', 'contact/create.php');
$router->post('/contact', 'contact/store.php');

// --- ADMİN PANELİ ---

// İstatistikler (Yeni Eklendi)
// Bu satır, /controllers/admin/stats/index.php dosyasını çalıştırır.
$router->get('/admin/stats', 'admin/stats/index.php');

// Yazı Yönetimi
$router->get('/admin', 'admin/index.php');
$router->get('/admin/posts/create', 'posts/create.php');
$router->post('/admin/posts', 'posts/store.php');
$router->get('/admin/posts/edit/{id}', 'posts/edit.php');
$router->patch('/admin/posts/{id}', 'posts/update.php');
$router->delete('/admin/posts/{id}', 'posts/destroy.php');

// Mesaj Yönetimi
$router->get('/admin/messages', 'admin/messages/index.php');
$router->get('/admin/messages/{id}', 'admin/messages/show.php');
$router->post('/admin/messages/delete', 'admin/messages/destroy.php');

// Giriş & Çıkış İşlemleri
$router->get('/login', 'auth/create.php');
$router->post('/login', 'auth/store.php');
$router->post('/logout', 'auth/destroy.php');

return $router;