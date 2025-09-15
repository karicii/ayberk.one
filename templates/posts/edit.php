<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <h1><?= $pageTitle ?></h1>

    <form id="post-form" class="admin-form" action="/admin/posts/<?= $post['id'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        
        <div class="form-group">
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="post_image">Kapak Görselini Değiştir (İsteğe Bağlı)</label>
            <input type="file" id="post_image" name="post_image">
            <?php if (!empty($post['image_path'])): ?>
                <p style="font-size: 0.8rem; margin-top: 0.5rem; color: var(--color-secondary);">Mevcut görsel: <?= basename($post['image_path']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Kategoriler</label>
            <div class="category-checkbox-group">
                <?php foreach ($categories as $category): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>" <?= in_array($category['id'], $postCategoryIds) ? 'checked' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="body">İçerik</label>
            <div id="editor" style="min-height: 250px;"><?= $post['body'] ?? '' ?></div>
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

        <div class="form-group">
            <button type="submit" class="button button-primary">Güncelle</button>
        </div>
    </form>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>