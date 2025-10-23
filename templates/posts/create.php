<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <div class="content-header">
        <h1><?= $pageTitle ?></h1>
        <a href="/admin" class="button">
            <i data-lucide="arrow-left"></i>
            <span>Geri Dön</span>
        </a>
    </div>

    <div class="content-panel">
        <form id="post-form" class="form" action="/admin/posts" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        
        <div class="form-group">
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= $_POST['title'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="post_image">Kapak Görseli</label>
            <input type="file" id="post_image" name="post_image">
        </div>

        <div class="form-group">
            <label>Kategoriler</label>
            <div class="category-checkbox-group">
                <?php foreach ($categories as $category): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Etiketler</label>
            <input 
                type="text" 
                id="tags_input" 
                name="tags_input" 
                placeholder="php, javascript, docker (virgülle ayırın)"
                class="form-control"
            >
            <small class="form-help">Etiketleri virgülle ayırarak yazın. Yeni etiketler otomatik oluşturulacak. Örn: php, javascript, docker</small>
            <div id="tags_preview" class="tags-preview" style="margin-top: 0.75rem;"></div>
        </div>

        <div class="form-group">
            <label for="body">İçerik</label>
            <div id="editor" style="min-height: 250px;"><?= $_POST['body'] ?? '' ?></div>
            <input type="hidden" name="body" id="body-content">
        </div>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" class="button button-primary">
                <i data-lucide="save"></i>
                <span>Kaydet</span>
            </button>
            <a href="/admin" class="button">İptal</a>
        </div>
        </form>
    </div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>