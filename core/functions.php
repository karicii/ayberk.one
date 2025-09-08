<?php

// GÜNCELLEME: Artık die() yerine /login'e yönlendiriyor.
function authorize() {
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
}

function view(string $path, array $data = []): void
{
    extract($data); 
    require BASE_PATH . "/templates/{$path}";
}

function slugify(string $text): string
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    if (empty($text)) {
        return 'n-a';
    }
    return strtolower($text);
}

function generate_json_ld(array $post): string
{
    $config = require BASE_PATH . '/core/config.php';
    $baseUrl = $config['app']['url'];
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $baseUrl . '/posts/' . $post['slug'],
        ],
        'headline' => $post['title'],
        'description' => substr(strip_tags($post['body']), 0, 155) . '...',
        'author' => [
            '@type' => 'Person',
            'name' => 'Ayberk',
            'url' => $baseUrl,
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Ayberk.one',
            'logo' => [
                '@type' => 'ImageObject',
            ],
        ],
        'datePublished' => date('Y-m-d', strtotime($post['created_at'])),
    ];
    
    $json = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    
    return '<script type="application/ld+json">' . $json . '</script>';
}