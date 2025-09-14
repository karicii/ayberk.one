<?php 
// --- DÜZELTME BURADA: base_path() fonksiyonu yerine BASE_PATH sabitini kullan ---
require(BASE_PATH . '/templates/partials/header.php'); 
?>

<main class="container">
    <div class="contact-form">
        <h1>İletişim</h1>

        <?php if (isset($errors) && !empty($errors)) : ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
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
            
            <button type="submit">Gönder</button>
        </form>
    </div>
</main>

<?php 
// --- DÜZELTME BURADA: base_path() fonksiyonu yerine BASE_PATH sabitini kullan ---
require(BASE_PATH . '/templates/partials/footer.php'); 
?>