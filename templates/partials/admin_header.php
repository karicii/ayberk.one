<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Admin' : 'Admin Paneli' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/admin.css">

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
</head>
<body>
    <div class="container">
        <header class="admin-header">
            <a href="/admin" class="logo">AYBERK.ONE | KONTROL PANELİ</a>
            <nav class="admin-nav">
                <a href="/admin/messages">Mesajlar</a>
                <form method="POST" action="/logout">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> <button type="submit" class="button-logout">Çıkış Yap</button>
                </form>
            </nav>
        </header>
        <main class="site-content">