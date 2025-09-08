<?php

function authorize() {
    if (!isset($_SESSION['user'])) {
        http_response_code(403);
        die('Bu sayfaya erişim yetkiniz yok.');
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

// YENİ FONKSİYON
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
        // 'image' => $baseUrl . ($post['image_url'] ?? '/assets/images/default.jpg'), // Veritabanında image_url sütunu olunca eklenecek.
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
                // 'url' => $baseUrl . '/assets/images/logo.png', // Logo olunca eklenecek.
            ],
        ],
        'datePublished' => date('Y-m-d', strtotime($post['created_at'])),
        // 'dateModified' => date('Y-m-d', strtotime($post['updated_at'])), // updated_at sütunu olunca eklenecek.
    ];
    
    $json = json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    
    return '<script type="application/ld+json">' . $json . '</script>';
}