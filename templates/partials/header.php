<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Ayberk.one' : 'Ayberk.one' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'Girişimci, yazılımcı. Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine notlar.' ?>">
    
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
                    <li><a href="/projeler">Projeler</a></li>
                    <li><a href="/hakkimda">Hakkımda</a></li>
                    <li><a href="/iletisim">İletişim</a></li>
                </ul>
            </nav>
        </header>
        <main class="site-content">