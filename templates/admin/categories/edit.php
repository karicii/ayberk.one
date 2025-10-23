<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <div class="content-header">
        <h1>Kategori Düzenle</h1>
        <a href="/admin/categories" class="button">
            <i data-lucide="arrow-left"></i>
            <span>Geri Dön</span>
        </a>
    </div>

    <div class="content-panel">
        <form method="POST" action="/admin/categories/<?= $category['id'] ?>" class="form">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group">
                <label for="name">Kategori Adı *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control <?= isset($_SESSION['errors']['name']) ? 'error' : '' ?>"
                    value="<?= htmlspecialchars($_SESSION['old']['name'] ?? $category['name']) ?>"
                    required
                    placeholder="Örn: Yazılım Geliştirme"
                >
                <?php if (isset($_SESSION['errors']['name'])): ?>
                    <span class="error-message"><?= $_SESSION['errors']['name'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="slug">Slug *</label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    class="form-control <?= isset($_SESSION['errors']['slug']) ? 'error' : '' ?>"
                    value="<?= htmlspecialchars($_SESSION['old']['slug'] ?? $category['slug']) ?>"
                    required
                    placeholder="Örn: yazilim-gelistirme"
                    pattern="[a-z0-9-]+"
                    title="Sadece küçük harf, rakam ve tire kullanabilirsiniz"
                >
                <small class="form-help">Sadece küçük harf, rakam ve tire kullanın. Örn: yazilim-gelistirme</small>
                <?php if (isset($_SESSION['errors']['slug'])): ?>
                    <span class="error-message"><?= $_SESSION['errors']['slug'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="button button-primary">
                    <i data-lucide="save"></i>
                    <span>Değişiklikleri Kaydet</span>
                </button>
                <a href="/admin/categories" class="button">İptal</a>
            </div>
        </form>
    </div>

<?php 
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
    require(BASE_PATH . '/templates/partials/admin_footer.php');
?>
