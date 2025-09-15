<?php

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

function set_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');

    $csp = "default-src 'self'; "; 
    // Cloudflare'in script adresini ekliyoruz.
    $csp .= "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://challenges.cloudflare.com; "; 
    $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; ";
    $csp .= "font-src https://fonts.gstatic.com; "; 
    $csp .= "img-src 'self' data:; ";
    // Cloudflare'in widget'ı (iframe) için izin ekliyoruz.
    $csp .= "frame-src https://challenges.cloudflare.com; ";
    $csp .= "form-action 'self'; ";
    $csp .= "object-src 'none'; "; 
    $csp .= "frame-ancestors 'none'; ";
    $csp .= "base-uri 'self'; ";
    $csp .= "upgrade-insecure-requests;"; 

    header("Content-Security-Policy: " . $csp);
}

function verify_turnstile(string $token, string $ip): bool
{
    $config = require BASE_PATH . '/core/config.php';
    $secretKey = $config['cloudflare']['secret_key'];

    if (!$secretKey) {
        // Eğer gizli anahtar ayarlanmamışsa, geliştirme ortamı için true dönebiliriz.
        // Canlıda mutlaka ayarlanmalıdır.
        return true; 
    }

    $payload = [
        'secret' => $secretKey,
        'response' => $token,
        'remoteip' => $ip
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://challenges.cloudflare.com/turnstile/v0/siteverify');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    
    return $result['success'] ?? false;
}