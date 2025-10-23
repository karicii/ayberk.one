<?php

$pageTitle = 'Hakkımda';
$pageDescription = 'Ayberk Arıcı kimdir? Ürün stratejisi, SaaS projeleri ve yapay zekâ destekli büyüme odağındaki yolculuğunu keşfedin.';

$highlight = 'Ürün odaklı girişimci, SaaS danışmanı ve yapay zekâ ile satış otomasyonları kurucusu.';

$focusAreas = [
    'SaaS & ürün stratejisi',
    'Yapay zekâ ile satış ve pazarlama',
    'Low-code prototipleme',
    'Gelir ve funnel optimizasyonu'
];

$stats = [
    [
        'label' => 'Internet girişim deneyimi',
        'value' => '12+ yıl'
    ],
    [
        'label' => 'Canlıya alınan ürün',
        'value' => '18'
    ],
    [
        'label' => 'Danışmanlık verdiği ekip',
        'value' => '40+'
    ],
    [
        'label' => 'Toplam kullanıcı',
        'value' => '500K+'
    ],
];

$now = [
    'Kolba ile yapay zekâ destekli eğitim deneyimleri tasarlıyor, ekibi ürün/pazar uyumuna taşıyorum.',
    'Kuruculara haftalık ürün kliniği oturumlarıyla büyüme, fiyatlandırma ve deney hızı konusunda eşlik ediyorum.',
    'Satış takımlarının tekrar eden süreçlerini otomatikleştiren AI destekli funnel projeleri kuruyorum.'
];

$timeline = [
    [
        'period' => '2024 — Şimdi',
        'title' => 'Kurucu & Ürün Stratejisti · Kolba',
        'description' => 'Öğrenme deneyimlerine odaklanan ürün ve servisleri, yapay zekâ ve davranışsal tasarım ile ölçekli hale getiriyoruz.'
    ],
    [
        'period' => '2021 — 2024',
        'title' => 'Growth Danışmanı · SaaS & Marketplaces',
        'description' => 'Abonelik, kredi ve komisyon modelleriyle çalışan ürünlere deney tabanlı büyüme sistemleri kurdum.'
    ],
    [
        'period' => '2017 — 2021',
        'title' => 'Kurucu Ortak · Studio Minoa',
        'description' => 'KOBİ ve girişimlerin dijital dönüşümü için no-code araçlarla 60+ ürün prototipi yayınladım.'
    ],
    [
        'period' => '2013 — 2017',
        'title' => 'Ürün Tasarımcısı & Yazılım Geliştirici',
        'description' => 'Çevik metodoloji ile çalışan takımlarda SaaS ürünleri, e-ticaret deneyimleri ve CRM entegrasyonları geliştirdim.'
    ],
];

$values = [
    [
        'title' => 'Deney kültürü',
        'description' => 'Her hipotez hızlıca sahada doğrulanır. Ölçüm olmadan ilerleme sayılmıyor.'
    ],
    [
        'title' => 'İnsan merkezli otomasyon',
        'description' => 'AI ve otomasyon, ekiplerin karar alma hızını arttırdığı sürece anlamlı.'
    ],
    [
        'title' => 'Şeffaf paylaşım',
        'description' => 'Hangi kararın neden alındığını açıkça anlatırım; müşteriler ve ekipler aynı veriyi görür.'
    ],
];

$toolbox = [
    [
        'title' => 'Ürün & Strateji',
        'items' => ['Ürün keşfi', 'Pricing & packaging', 'Roadmap oluşturma', 'OKR ve North Star metrikleri']
    ],
    [
        'title' => 'Geliştirme',
        'items' => ['Laravel & PHP', 'Next.js & React', 'Tailwind CSS', 'Supabase', 'Playwright & Cypress']
    ],
    [
        'title' => 'Büyüme',
        'items' => ['Funnel analizi', 'Lifecycle e-posta', 'AI destekli satış sekansları', 'NPS & müşteri araştırması']
    ],
];

view('about/index.php', [
    'pageTitle' => $pageTitle,
    'pageDescription' => $pageDescription,
    'highlight' => $highlight,
    'focusAreas' => $focusAreas,
    'stats' => $stats,
    'now' => $now,
    'timeline' => $timeline,
    'values' => $values,
    'toolbox' => $toolbox
]);
