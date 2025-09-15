<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli Girişi | Ayberk.one</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="login-page-body">

<div class="login-container">
    <div class="login-header">
        <a href="/" class="logo">AYBERK.ONE</a>
        <span>Kontrol Paneli</span>
    </div>

    <form class="admin-form" action="/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        
        <?php if (isset($error)): ?>
            <p class="login-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <div class="form-group">
            <label for="email">E-posta</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Şifre</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="button button-primary" style="width: 100%;">Giriş Yap</button>
        </div>
    </form>
</div>

</body>
</html>