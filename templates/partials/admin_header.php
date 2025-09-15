<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | Admin' : 'Admin Paneli' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/admin.css">

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    
    <script src="https://unpkg.com/lucide-react@0.292.0/dist/umd/lucide.js"></script>
</head>
<body class="admin-body">
    <?php $current_uri = $_SERVER['REQUEST_URI']; ?>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/admin" class="sidebar-logo">AYBERK.ONE</a>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="/admin" class="<?= strpos($current_uri, '/admin/posts') !== false || $current_uri === '/admin' ? 'active' : '' ?>">
                            <i data-lucide="layout-dashboard"></i>
                            <span>Yazı Yönetimi</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/messages" class="<?= strpos($current_uri, '/admin/messages') !== false ? 'active' : '' ?>">
                            <i data-lucide="inbox"></i>
                            <span>Mesajlar</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="/logout">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <button type="submit" class="button-logout">
                        <i data-lucide="log-out"></i>
                        <span>Çıkış Yap</span>
                    </button>
                </form>
            </div>
        </aside>
        <div class="main-container">
            <main class="main-content">