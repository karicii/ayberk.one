<?php

$db = App::resolve('database');
global $router;
$slug = $router->params('slug');

$post = $db->query('SELECT * FROM posts WHERE slug = :slug', [':slug' => $slug])->find();

if (!$post) {
    http_response_code(404);
    require BASE_PATH . "/templates/404.php";
    die();
}

// SEO Meta Etiketleri
$pageTitle = $post['title'];
$pageDescription = substr(strip_tags($post['body']), 0, 155) . '...';

// SEO Yapısal Veri
$jsonLdSchema = generate_json_ld($post);

// --- YENİ EKLENEN SATIR ---
// Bu değişken, header ve footer'a bu sayfanın özel bir yerleşime sahip olduğunu söyleyecek.
$isPostShowPage = true; 

view('posts/show.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'post' => $post,
    'jsonLdSchema' => $jsonLdSchema,
    'isPostShowPage' => $isPostShowPage // Değişkeni view'e gönder
]);