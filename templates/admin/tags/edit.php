<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <div class="content-header">
        <h1>Etiket Düzenle</h1>
        <a href="/admin/tags" class="button">
            <i data-lucide="arrow-left"></i>
            <span>Geri Dön</span>
        </a>
    </div>

    <div class="content-panel">
        <form method="POST" action="/admin/tags/<?= $tag['id'] ?>" class="form">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group">
                <label for="name">Etiket Adı *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control <?= isset($_SESSION['errors']['name']) ? 'error' : '' ?>"
                    value="<?= htmlspecialchars($_SESSION['old']['name'] ?? $tag['name']) ?>"
                    required
                    placeholder="Örn: PHP"
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
                    value="<?= htmlspecialchars($_SESSION['old']['slug'] ?? $tag['slug']) ?>"
                    required
                    placeholder="Örn: php"
                    pattern="[a-z0-9-]+"
                    title="Sadece küçük harf, rakam ve tire kullanabilirsiniz"
                >
                <small class="form-help">Sadece küçük harf, rakam ve tire kullanın. Örn: php</small>
                <?php if (isset($_SESSION['errors']['slug'])): ?>
                    <span class="error-message"><?= $_SESSION['errors']['slug'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Açıklama</label>
                <textarea 
                    id="description" 
                    name="description" 
                    class="form-control"
                    rows="3"
                    placeholder="Etiket hakkında kısa bir açıklama (opsiyonel)"
                ><?= htmlspecialchars($_SESSION['old']['description'] ?? $tag['description'] ?? '') ?></textarea>
                <small class="form-help">Bu açıklama etiket sayfasında görüntülenecektir.</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="button button-primary">
                    <i data-lucide="save"></i>
                    <span>Güncelle</span>
                </button>
                <a href="/admin/tags" class="button">İptal</a>
            </div>
        </form>
    </div>

    <script>
        // Manuel slug düzenlemeyi izin ver
        document.getElementById('slug').addEventListener('input', function(e) {
            this.dataset.manualEdit = 'true';
        });
    </script>

<?php 
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
?>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>
