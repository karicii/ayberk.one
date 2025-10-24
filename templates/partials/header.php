<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Ayberk.one' : 'Ayberk.one' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'Girişimci, yazılımcı. Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine notlar.' ?>">
    
    <?php if (isset($keywords) && !empty($keywords)): ?>
    <meta name="keywords" content="<?= htmlspecialchars(implode(', ', $keywords)) ?>">
    <?php endif; ?>
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?= isset($isPostShowPage) && $isPostShowPage ? 'article' : 'website' ?>">
    <meta property="og:url" content="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
    <meta property="og:title" content="<?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Ayberk.one' ?>">
    <meta property="og:description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'Girişimci, yazılımcı. Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine notlar.' ?>">
    <?php if (isset($post['image_path']) && !empty($post['image_path'])): ?>
    <meta property="og:image" content="<?= htmlspecialchars($post['image_path']) ?>">
    <?php endif; ?>
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
    <meta name="twitter:title" content="<?= isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Ayberk.one' ?>">
    <meta name="twitter:description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'Girişimci, yazılımcı. Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine notlar.' ?>">
    <?php if (isset($post['image_path']) && !empty($post['image_path'])): ?>
    <meta name="twitter:image" content="<?= htmlspecialchars($post['image_path']) ?>">
    <?php endif; ?>
    
    <link rel="canonical" href="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
    <link rel="alternate" type="application/rss+xml" title="Ayberk.one RSS Feed" href="/feed">
    <link rel="icon" type="icon" href="/assets/images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/main.css">
    
    <?= $jsonLdSchema ?? '' ?>
</head>
<body>
    <div class="container">
        <header class="site-header">
            <a href="/" class="logo">AYBERK.ONE</a>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="/"><?= t('home') ?></a></li>
                    <li><a href="/notes"><?= t('notes') ?></a></li>
                    <li><a href="/hakkimda"><?= t('about') ?></a></li>
                    <li><a href="/contact"><?= t('contact') ?></a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <button id="mobile-search-toggle" class="mobile-search-toggle" aria-label="Ara">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
                <div class="lang-switcher">
                    <button id="lang-toggle" class="lang-toggle" aria-label="Dil Seç">
                        <span class="lang-current">TR</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="lang-dropdown">
                        <button class="lang-option active" data-lang="tr">Türkçe</button>
                        <button class="lang-option" data-lang="en">English</button>
                        <button class="lang-option" data-lang="fr">Français</button>
                    </div>
                </div>
                <button id="theme-toggle" class="theme-toggle" aria-label="Tema Değiştir">
                    <svg id="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <svg id="theme-icon-moon" style="display:none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>
                <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-label="Menü">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <form action="/search" method="GET" class="header-search">
                    <input type="text" name="q" placeholder="<?= t('search') ?>" aria-label="<?= t('search') ?>">
                    <button type="submit" aria-label="<?= t('search') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </header>
        <div id="mobile-search-overlay" class="mobile-search-overlay">
            <button id="mobile-search-close" class="mobile-search-close" aria-label="Kapat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <form action="/search" method="GET" class="mobile-search-form">
                <input type="text" name="q" placeholder="<?= t('search') ?>" aria-label="<?= t('search') ?>" autofocus>
                <button type="submit" aria-label="<?= t('search') ?>"><?= t('search') ?></button>
            </form>
        </div>
        <main class="site-content">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error_message']) ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['info_message'])): ?>
            <div class="alert alert-info">
                <?= htmlspecialchars($_SESSION['info_message']) ?>
                <?php unset($_SESSION['info_message']); ?>
            </div>
        <?php endif; ?>
