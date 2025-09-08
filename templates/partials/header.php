<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Ayberk.one' : 'Ayberk.one' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? htmlspecialchars($pageDescription) : 'Girişimci, yazılımcı. Web projeleri, SaaS ürünleri ve yazılım tabanlı satış sistemleri üzerine notlar.' ?>">
    
    <link rel="stylesheet" href="/assets/css/main.css">
    
    <?= $jsonLdSchema ?? '' ?>
</head>
<body>
    <div class="container">
        <header class="site-header">
            <a href="/" class="logo">Ayberk.one</a>
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