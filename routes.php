<?php

$router = new Router();

$router->get('/', 'home.php');
$router->get('/yazilar', 'posts.php');
$router->get('/proje', 'post.php'); // Örnek tekil proje/yazı sayfası

return $router;