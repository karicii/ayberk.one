<?php 
// config dosyasını çağırarak Site Key'i alıyoruz
$config = require(BASE_PATH . '/core/config.php');
$turnstileSiteKey = $config['cloudflare']['site_key'] ?? '';

require(BASE_PATH . '/templates/partials/header.php'); 
?>

<main class="container">
    <div class="contact-form-container">
        <h1>Bana Ulaşın</h1>

        <?php if (isset($errors) && !empty($errors)) : ?>
            <div class="errors">
                <?php foreach ($errors as $error) : ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="/contact" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            
            <div class="form-group">
                <label for="name">Adınız Soyadınız</label>
                <input type="text" id="name" name="name" value="<?= $old['name'] ?? '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-posta Adresiniz</label>
                <input type="email" id="email" name="email" value="<?= $old['email'] ?? '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="message">Mesajınız</label>
                <textarea id="message" name="message" rows="6" required><?= $old['message'] ?? '' ?></textarea>
            </div>
            
            <?php if ($turnstileSiteKey): ?>
            <div class="cf-turnstile" data-sitekey="<?= htmlspecialchars($turnstileSiteKey) ?>" data-theme="dark"></div>
            <?php endif; ?>
            
            <button type="submit" class="button button-primary" style="width: 100%; padding: 12px; margin-top: 1.5rem;">Gönder</button>
        </form>
    </div>
</main>

<?php 
require(BASE_PATH . '/templates/partials/footer.php'); 

if ($turnstileSiteKey) {
    echo '<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>';
}
?>