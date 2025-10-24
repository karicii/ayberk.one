<?php require BASE_PATH . '/templates/partials/admin_header.php'; ?>

<div class="content-header">
    <h1>Notu Düzenle</h1>
    <a href="/admin/notes" class="button">
        <i data-lucide="arrow-left"></i>
        <span>Geri Dön</span>
    </a>
</div>

<div class="content-panel">
    <form method="POST" action="/admin/notes/<?= $note['id'] ?>" class="admin-form">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        
        <div class="form-group">
            <label for="title">Başlık *</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <input type="text" id="category" name="category" value="<?= htmlspecialchars($note['category'] ?? '') ?>" placeholder="Örn: PHP, JavaScript, DevOps">
            <small>İsteğe bağlı - notları gruplamak için</small>
        </div>

        <div class="form-group">
            <label for="content">İçerik *</label>
            <textarea id="content" name="content" rows="15" required><?= htmlspecialchars($note['content']) ?></textarea>
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_published" <?= $note['is_published'] ? 'checked' : '' ?>>
                <span>Yayında</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="button button-primary">
                <i data-lucide="save"></i>
                <span>Değişiklikleri Kaydet</span>
            </button>
            <a href="/admin/notes" class="button">İptal</a>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();
</script>

<?php require BASE_PATH . '/templates/partials/admin_footer.php'; ?>
