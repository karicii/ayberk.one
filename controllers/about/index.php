<?php

$pageTitle = 'Hakkımda';
$pageDescription = 'Ayberk Arıcı kimdir? Ürün stratejisi, SaaS projeleri ve yapay zekâ destekli büyüme odağındaki yolculuğunu keşfedin.';

$highlight = 'Her zaman ürünlerin nasıl "çalıştığına" değil, neden işe yaradığına odaklandım.';

$focusAreas = [
    'Yapay zekâ × Davranışsal tasarım',
    'Ölçekli öğrenme sistemleri',
    'Deney kültürü & Otomasyon',
    'SaaS ürün/pazar uyumu'
];

$stats = [
    [
        'label' => 'İlk internet girişimi',
        'value' => '12 yaşında'
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
    '18 yaşında ürün odaklı bir girişimci olarak Lume ekosistemini kuruyorum — Kai, Seed CMS ve daha fazlası.',
    'Yapay zekâ, ürün tasarımı ve satış psikolojisini birleştirip ölçeklenebilir sistemler kuruyorum. İşim sadece kod değil; davranışı modellemek.',
    'Bir gün Sun Microsystems gibi kendi R&D laboratuvarımı kuracağım. Bugün attığım her adım, o laboratuvarın tuğlası.'
];

$timeline = [
    [
        'period' => '2025 — Şimdi',
        'title' => 'Kurucu · Lume Ekosistemi',
        'description' => 'Lume artık bir marka değil, bir çatı. Kai gibi AI-tabanlı SaaS projeleri ve Seed CMS gibi açık kaynak sistemler geliştiriyorum. Davranışı modelleyerek ölçeklenebilir sistemler kuruyorum.'
    ],
    [
        'period' => '2024',
        'title' => 'Kurucu · Lume',
        'description' => 'İlk ciddi işimi kendi kendime bootstrap ettim. Gündüz kod yazıyor, gece müşteri buluyordum. 999 TL\'lik ilk satıştan 5.000 TL\'ye, küçük bir ajansı profesyonel yapıya çevirdim. Öğrendiğim şey: Para kazanmak kolay, güven inşa etmek zor.'
    ],
    [
        'period' => '2023',
        'title' => 'Dönüşüm Yılı · Lume Laboratuvarı',
        'description' => 'Lisede herkes üniversite düşünürken ben Lume\'yi kuruyordum. Sadece ajans değil, benim laboratuvarımdı. Yüzlerce fikir test ettim, bazıları başarısız oldu ama her başarısızlık beni keskinleştirdi. Yapay zekâyla iş süreçlerini hızlandıran sistemler kurma hedefim netleşti.'
    ],
    [
        'period' => '2021 — 2022',
        'title' => 'Öğrenme & Keşif',
        'description' => 'HTML, CSS, sonra PHP. İlk defa tamamen kendi kodladığım siteleri yayınladım. Sadece kodlamayı değil, insanların neye tıkladığını, neyi sevdiğini, neden satın aldığını gözlemlemeye başladım. Teknikten stratejiye geçişin temeli burada atıldı.'
    ],
    [
        'period' => '2019 — 2020',
        'title' => 'İlk Kıvılcım',
        'description' => '11 yaşında HTML etiketlerini karıştırıyor, YouTube\'da "nasıl site yapılır" videoları izliyordum. 2019\'da kendi blogumu kurdum. Pandemiyle birlikte bilgisayar artık sadece eğlence değil, üretim aracı oldu. Bir şeyler üretmenin dijitalde nasıl mümkün olduğunu o yaşta fark ettim.'
    ],
];

$values = [
    [
        'title' => 'Deney kültürü',
        'description' => 'Ölçülemeyen hiçbir şey gelişmez. Her fikir hızlıca test edilir, başarısızlıklar beni daha keskin hale getirir.'
    ],
    [
        'title' => 'İnsan merkezli AI',
        'description' => 'AI\'nin insanı değil, insanın AI\'yı yönetmesi gerekir. Yapay zekâyı insan merkezli hale getiriyorum.'
    ],
    [
        'title' => 'Davranışı modellemek',
        'description' => 'İnsanların neye tıkladığını, neyi sevdiğini, neden satın aldığını anlamak — işim sadece kod değil, davranış modellemek.'
    ],
    [
        'title' => 'Bootstrap zihniyeti',
        'description' => 'Dış yatırım beklemeden inşa ederim. Para kazanmak kolay, güven inşa etmek zor — ben güvene yatırım yaparım.'
    ],
];

$toolbox = [
    [
        'title' => 'Backend & Sistemler',
        'items' => ['PHP (Laravel & Raw)', 'Node.js', 'Fortran', 'Docker & Konteynerler']
    ],
    [
        'title' => 'Frontend & Tasarım',
        'items' => ['JavaScript (Vanilla & Framework)', 'HTML/CSS', 'Responsive Design', 'UI/UX Prototipleme']
    ],
    [
        'title' => 'Altyapı & DevOps',
        'items' => ['Linux Shell (Bash/Zsh)', 'Docker Compose', 'Git & Versiyon Kontrol', 'CI/CD Pipeline']
    ],
    [
        'title' => 'Strateji & Büyüme',
        'items' => ['Funnel analizi', 'AI destekli otomasyon', 'Deney kültürü', 'Ürün/pazar uyumu']
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
