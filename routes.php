<?php

$router = new Router();

// Genel Sayfalar
$router->get('/', 'home.php');
$router->get('/posts/{slug}', 'posts/show.php');
$router->get('/category/{slug}', 'categories/show.php'); // Yeni eklenen kategori yolu
$router->get('/tags', 'tags/index.php');
$router->get('/tag/{slug}', 'tags/show.php');
$router->get('/arsiv', 'archive/index.php');
$router->get('/arsiv/{year}', 'archive/index.php');
$router->get('/arsiv/{year}/{month}', 'archive/index.php');
$router->get('/search', 'search/index.php');
$router->get('/notes', 'notes/index.php');
$router->get('/notes/{slug}', 'notes/show.php');
$router->get('/feed', 'feed.php');
$router->get('/rss', 'feed.php');
$router->get('/hakkimda', 'about/index.php');
$router->get('/aboutme', 'about/index.php');
$router->get('/sitemap.xml', 'sitemap.php');
$router->get('/contact', 'contact/create.php');
$router->post('/contact', 'contact/store.php');

// Newsletter
$router->post('/newsletter/subscribe', 'newsletter/subscribe.php');
$router->get('/newsletter/unsubscribe', 'newsletter/unsubscribe.php');

// API
$router->post('/api/set-language', 'api/set-language.php');

// Admin - Yazı Yönetimi
$router->get('/admin', 'admin/index.php'); 
$router->get('/admin/posts/create', 'posts/create.php');
$router->post('/admin/posts', 'posts/store.php');
$router->get('/admin/posts/edit/{id}', 'posts/edit.php');
$router->patch('/admin/posts/{id}', 'posts/update.php');
$router->delete('/admin/posts/{id}', 'posts/destroy.php');

// Admin - Mesaj Yönetimi
$router->get('/admin/messages', 'admin/messages/index.php');
$router->get('/admin/messages/{id}', 'admin/messages/show.php');
$router->post('/admin/messages/delete', 'admin/messages/destroy.php');

// Admin - Kategori Yönetimi
$router->get('/admin/categories', 'admin/categories/index.php');
$router->get('/admin/categories/create', 'admin/categories/create.php');
$router->post('/admin/categories', 'admin/categories/store.php');
$router->get('/admin/categories/edit/{id}', 'admin/categories/edit.php');
$router->patch('/admin/categories/{id}', 'admin/categories/update.php');
$router->delete('/admin/categories/{id}', 'admin/categories/destroy.php');

// Admin - Etiket Yönetimi
$router->get('/admin/tags', 'admin/tags/index.php');
$router->get('/admin/tags/create', 'admin/tags/create.php');
$router->post('/admin/tags', 'admin/tags/store.php');
$router->get('/admin/tags/edit/{id}', 'admin/tags/edit.php');
$router->patch('/admin/tags/{id}', 'admin/tags/update.php');
$router->delete('/admin/tags/{id}', 'admin/tags/destroy.php');

// Admin - Newsletter Yönetimi
$router->get('/admin/newsletter', 'admin/newsletter/index.php');
$router->patch('/admin/newsletter/reactivate', 'admin/newsletter/reactivate.php');
$router->delete('/admin/newsletter/delete', 'admin/newsletter/delete.php');

// Admin - Not Yönetimi
$router->get('/admin/notes', 'admin/notes/index.php');
$router->get('/admin/notes/create', 'admin/notes/create.php');
$router->post('/admin/notes', 'admin/notes/store.php');
$router->get('/admin/notes/edit/{id}', 'admin/notes/edit.php');
$router->patch('/admin/notes/{id}', 'admin/notes/update.php');
$router->delete('/admin/notes/{id}', 'admin/notes/destroy.php');

// Admin - Giriş/Çıkış
$router->get('/login', 'auth/create.php');
$router->post('/login', 'auth/store.php');
$router->post('/logout', 'auth/destroy.php');


return $router;