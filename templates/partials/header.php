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
                    <li><a href="/">Anasayfa</a></li>
                    <li><a href="/hakkimda">Hakkımda</a></li>
                    <li><a href="/contact">İletişim</a></li>
                </ul>
            </nav>
            <form action="/search" method="GET" class="header-search">
                <input type="text" name="q" placeholder="Ara..." aria-label="Arama">
                <button type="submit" aria-label="Ara">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </form>
        </header>
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
