<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Admin' : 'Admin Paneli' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <header class="admin-header">
        <a href="/admin" class="logo">AYBERK.ONE | KONTROL PANELİ</a>
        <nav class="admin-nav">
            <form method="POST" action="/logout">
                <button type="submit" class="logout-button">Çıkış Yap</button>
            </form>
        </nav>
    </header>
    <main class="admin-container">