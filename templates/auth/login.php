<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

<div class="login-container">
    <h1>Giriş Yap</h1>
    <form class="admin-form" action="/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
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
            <button type="submit">Giriş Yap</button>
        </div>
    </form>
</div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>