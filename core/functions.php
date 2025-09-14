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

// --- YENİ EKLENEN GÜVENLİK BAŞLIKLARI FONKSİYONU ---
function set_security_headers() {
    // Tarayıcının, içeriği "MIME type sniffing" ile tahmin etmesini engeller. Bu, XSS'e karşı korur.
    header('X-Content-Type-Options: nosniff');

    // Sitenin bir <iframe> içinde yüklenmesini engelleyerek "clickjacking" saldırılarını önler.
    header('X-Frame-Options: DENY');

    // Tarayıcının dahili XSS filtresini etkinleştirir. (Modern tarayıcılarda CSP daha etkilidir)
    header('X-XSS-Protection: 1; mode=block');

    // Sadece HTTPS üzerinden iletişim kurulmasını zorunlu kılar (canlıda HTTPS kuruluysa etkilidir).
    // Bir yıl boyunca tarayıcıya sadece HTTPS kullanmasını söyler.
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');

    // İzin verilen kaynakları tanımlayan İçerik Güvenliği Politikası (CSP)
    $csp = "default-src 'self'; "; // Varsayılan olarak sadece kendi kaynağından gelenlere izin ver
    $csp .= "script-src 'self' https://cdn.jsdelivr.net; "; // Scriptler: Kendi kaynağın ve QuillJS'in CDN'i
    $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; "; // Stiller: Kendi kaynağın, Google Fonts ve QuillJS'in CDN'i
    $csp .= "font-src https://fonts.gstatic.com; "; // Fontlar: Sadece Google Fonts
    $csp .= "img-src 'self' data:; "; // Resimler: Kendi kaynağın ve data: URI'ları (base64 resimler için)
    $csp .= "form-action 'self'; "; // Formlar sadece kendi kaynağına gönderilebilir
    $csp .= "object-src 'none'; "; // <object>, <embed>, <applet> gibi eklentileri engelle
    $csp .= "frame-ancestors 'none'; "; // Sitenin iframe içinde yüklenmesini engelle
    $csp .= "base-uri 'self'; "; // <base> etiketinin kötüye kullanılmasını engelle
    $csp .= "upgrade-insecure-requests;"; // Tüm HTTP isteklerini otomatik olarak HTTPS'e yükselt

    header("Content-Security-Policy: " . $csp);
}
// ----------------------------------------------------