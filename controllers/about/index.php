<?php

require_once BASE_PATH . '/core/helpers/i18n.php';

$lang = get_lang();

// Page Meta
$pageTitles = [
    'tr' => 'Hakkımda',
    'en' => 'About Me',
    'fr' => 'À Propos'
];

$pageDescriptions = [
    'tr' => 'Ayberk Arıcı kimdir? Ürün stratejisi, SaaS projeleri ve yapay zekâ destekli büyüme odağındaki yolculuğunu keşfedin.',
    'en' => 'Who is Ayberk Arıcı? Discover his journey focused on product strategy, SaaS projects, and AI-powered growth.',
    'fr' => 'Qui est Ayberk Arıcı? Découvrez son parcours axé sur la stratégie produit, les projets SaaS et la croissance alimentée par l\'IA.'
];

$highlights = [
    'tr' => 'Her zaman ürünlerin nasıl "çalıştığına" değil, neden işe yaradığına odaklandım.',
    'en' => 'I\'ve always focused on why products work, not just how they "function".',
    'fr' => 'Je me suis toujours concentré sur la raison pour laquelle les produits fonctionnent, pas seulement sur leur "fonctionnement".'
];

$focusAreasData = [
    'tr' => [
        'Yapay zekâ × Davranışsal tasarım',
        'Ölçekli öğrenme sistemleri',
        'Deney kültürü & Otomasyon',
        'SaaS ürün/pazar uyumu'
    ],
    'en' => [
        'AI × Behavioral Design',
        'Scalable Learning Systems',
        'Experimentation Culture & Automation',
        'SaaS Product/Market Fit'
    ],
    'fr' => [
        'IA × Design Comportemental',
        'Systèmes d\'Apprentissage Évolutifs',
        'Culture d\'Expérimentation & Automation',
        'Adéquation Produit/Marché SaaS'
    ]
];

$pageTitle = $pageTitles[$lang];
$pageDescription = $pageDescriptions[$lang];
$highlight = $highlights[$lang];
$focusAreas = $focusAreasData[$lang];

$statsData = [
    'tr' => [
        ['label' => 'İlk internet girişimi', 'value' => '12 yaşında'],
        ['label' => 'Canlıya alınan ürün', 'value' => '18'],
        ['label' => 'Danışmanlık verdiği ekip', 'value' => '40+'],
        ['label' => 'Toplam kullanıcı', 'value' => '500K+']
    ],
    'en' => [
        ['label' => 'First internet venture', 'value' => 'Age 12'],
        ['label' => 'Products launched', 'value' => '18'],
        ['label' => 'Teams consulted', 'value' => '40+'],
        ['label' => 'Total users', 'value' => '500K+']
    ],
    'fr' => [
        ['label' => 'Première entreprise internet', 'value' => 'À 12 ans'],
        ['label' => 'Produits lancés', 'value' => '18'],
        ['label' => 'Équipes conseillées', 'value' => '40+'],
        ['label' => 'Utilisateurs totaux', 'value' => '500K+']
    ]
];

$stats = $statsData[$lang];

$nowData = [
    'tr' => [
        '18 yaşında ürün odaklı bir girişimci olarak Lume ekosistemini kuruyorum — Kai, Seed CMS ve daha fazlası.',
        'Yapay zekâ, ürün tasarımı ve satış psikolojisini birleştirip ölçeklenebilir sistemler kuruyorum. İşim sadece kod değil; davranışı modellemek.',
        'Bir gün Sun Microsystems gibi kendi R&D laboratuvarımı kuracağım. Bugün attığım her adım, o laboratuvarın tuğlası.'
    ],
    'en' => [
        'At 18, I\'m building the Lume ecosystem as a product-focused entrepreneur — Kai, Seed CMS, and more.',
        'I combine AI, product design, and sales psychology to build scalable systems. My work isn\'t just code; it\'s modeling behavior.',
        'One day I\'ll build my own R&D lab like Sun Microsystems. Every step I take today is a brick in that foundation.'
    ],
    'fr' => [
        'À 18 ans, je construis l\'écosystème Lume en tant qu\'entrepreneur axé sur les produits — Kai, Seed CMS et plus encore.',
        'Je combine l\'IA, la conception de produits et la psychologie des ventes pour créer des systèmes évolutifs. Mon travail n\'est pas seulement du code ; c\'est modéliser le comportement.',
        'Un jour, je construirai mon propre laboratoire R&D comme Sun Microsystems. Chaque pas que je fais aujourd\'hui est une brique dans ces fondations.'
    ]
];

$now = $nowData[$lang];

$timelineData = [
    'tr' => [
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
        ]
    ],
    'en' => [
        [
            'period' => '2025 — Present',
            'title' => 'Founder · Lume Ecosystem',
            'description' => 'Lume is no longer just a brand, it\'s an umbrella. I develop AI-based SaaS projects like Kai and open-source systems like Seed CMS. Building scalable systems by modeling behavior.'
        ],
        [
            'period' => '2024',
            'title' => 'Founder · Lume',
            'description' => 'I bootstrapped my first serious business. Writing code during the day, finding clients at night. From my first ₺999 sale to ₺5,000, I turned a small agency into a professional structure. The lesson: Making money is easy, building trust is hard.'
        ],
        [
            'period' => '2023',
            'title' => 'Transformation Year · Lume Lab',
            'description' => 'While everyone in high school was thinking about university, I was building Lume. Not just an agency, but my laboratory. I tested hundreds of ideas, some failed, but every failure sharpened me. My goal to build systems that accelerate business processes with AI became clear.'
        ],
        [
            'period' => '2021 — 2022',
            'title' => 'Learning & Discovery',
            'description' => 'HTML, CSS, then PHP. I published sites I coded completely by myself for the first time. I started observing not just coding, but what people click, what they like, why they buy. The foundation of the transition from technical to strategic was laid here.'
        ],
        [
            'period' => '2019 — 2020',
            'title' => 'First Spark',
            'description' => 'At 11, I was messing with HTML tags, watching "how to build a website" videos on YouTube. I built my own blog in 2019. With the pandemic, the computer became not just an entertainment tool but a production tool. I realized at that age how creating things digitally was possible.'
        ]
    ],
    'fr' => [
        [
            'period' => '2025 — Présent',
            'title' => 'Fondateur · Écosystème Lume',
            'description' => 'Lume n\'est plus qu\'une marque, c\'est un parapluie. Je développe des projets SaaS basés sur l\'IA comme Kai et des systèmes open-source comme Seed CMS. Construire des systèmes évolutifs en modélisant les comportements.'
        ],
        [
            'period' => '2024',
            'title' => 'Fondateur · Lume',
            'description' => 'J\'ai bootstrappé ma première entreprise sérieuse. Coder pendant la journée, trouver des clients la nuit. De ma première vente de 999 ₺ à 5 000 ₺, j\'ai transformé une petite agence en structure professionnelle. La leçon : gagner de l\'argent est facile, construire la confiance est difficile.'
        ],
        [
            'period' => '2023',
            'title' => 'Année de Transformation · Labo Lume',
            'description' => 'Alors que tout le monde au lycée pensait à l\'université, je construisais Lume. Pas seulement une agence, mais mon laboratoire. J\'ai testé des centaines d\'idées, certaines ont échoué, mais chaque échec m\'a aiguisé. Mon objectif de construire des systèmes qui accélèrent les processus commerciaux avec l\'IA s\'est clarifié.'
        ],
        [
            'period' => '2021 — 2022',
            'title' => 'Apprentissage & Découverte',
            'description' => 'HTML, CSS, puis PHP. J\'ai publié pour la première fois des sites que j\'avais entièrement codés moi-même. J\'ai commencé à observer non seulement le codage, mais ce que les gens cliquent, ce qu\'ils aiment, pourquoi ils achètent. Les fondations de la transition du technique au stratégique ont été posées ici.'
        ],
        [
            'period' => '2019 — 2020',
            'title' => 'Première Étincelle',
            'description' => 'À 11 ans, je bricolais avec les balises HTML, regardant des vidéos "comment créer un site web" sur YouTube. J\'ai créé mon propre blog en 2019. Avec la pandémie, l\'ordinateur est devenu non seulement un outil de divertissement mais un outil de production. J\'ai réalisé à cet âge comment créer des choses numériquement était possible.'
        ]
    ]
];

$timeline = $timelineData[$lang];

$valuesData = [
    'tr' => [
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
        ]
    ],
    'en' => [
        [
            'title' => 'Experimentation Culture',
            'description' => 'Nothing that can\'t be measured improves. Every idea is tested quickly, failures make me sharper.'
        ],
        [
            'title' => 'Human-Centered AI',
            'description' => 'AI shouldn\'t control humans; humans should control AI. I\'m making artificial intelligence human-centered.'
        ],
        [
            'title' => 'Modeling Behavior',
            'description' => 'Understanding what people click, what they like, why they buy — my work isn\'t just code, it\'s modeling behavior.'
        ],
        [
            'title' => 'Bootstrap Mindset',
            'description' => 'I build without waiting for external investment. Making money is easy, building trust is hard — I invest in trust.'
        ]
    ],
    'fr' => [
        [
            'title' => 'Culture d\'Expérimentation',
            'description' => 'Rien de ce qui ne peut pas être mesuré ne s\'améliore. Chaque idée est testée rapidement, les échecs m\'aiguisent.'
        ],
        [
            'title' => 'IA Centrée sur l\'Humain',
            'description' => 'L\'IA ne devrait pas contrôler les humains ; les humains devraient contrôler l\'IA. Je rends l\'intelligence artificielle centrée sur l\'humain.'
        ],
        [
            'title' => 'Modéliser le Comportement',
            'description' => 'Comprendre ce que les gens cliquent, ce qu\'ils aiment, pourquoi ils achètent — mon travail n\'est pas seulement du code, c\'est modéliser le comportement.'
        ],
        [
            'title' => 'Mentalité Bootstrap',
            'description' => 'Je construis sans attendre d\'investissement externe. Gagner de l\'argent est facile, construire la confiance est difficile — j\'investis dans la confiance.'
        ]
    ]
];

$values = $valuesData[$lang];

$toolboxData = [
    'tr' => [
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
        ]
    ],
    'en' => [
        [
            'title' => 'Backend & Systems',
            'items' => ['PHP (Laravel & Raw)', 'Node.js', 'Fortran', 'Docker & Containers']
        ],
        [
            'title' => 'Frontend & Design',
            'items' => ['JavaScript (Vanilla & Framework)', 'HTML/CSS', 'Responsive Design', 'UI/UX Prototyping']
        ],
        [
            'title' => 'Infrastructure & DevOps',
            'items' => ['Linux Shell (Bash/Zsh)', 'Docker Compose', 'Git & Version Control', 'CI/CD Pipeline']
        ],
        [
            'title' => 'Strategy & Growth',
            'items' => ['Funnel analysis', 'AI-powered automation', 'Experimentation culture', 'Product/market fit']
        ]
    ],
    'fr' => [
        [
            'title' => 'Backend & Systèmes',
            'items' => ['PHP (Laravel & Raw)', 'Node.js', 'Fortran', 'Docker & Conteneurs']
        ],
        [
            'title' => 'Frontend & Design',
            'items' => ['JavaScript (Vanilla & Framework)', 'HTML/CSS', 'Design Responsive', 'Prototypage UI/UX']
        ],
        [
            'title' => 'Infrastructure & DevOps',
            'items' => ['Linux Shell (Bash/Zsh)', 'Docker Compose', 'Git & Contrôle de Version', 'Pipeline CI/CD']
        ],
        [
            'title' => 'Stratégie & Croissance',
            'items' => ['Analyse de funnel', 'Automation alimentée par l\'IA', 'Culture d\'expérimentation', 'Adéquation produit/marché']
        ]
    ]
];

$toolbox = $toolboxData[$lang];

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
