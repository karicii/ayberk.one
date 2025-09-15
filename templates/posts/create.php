<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

<div class="content-header">
    <h1><?= $pageTitle ?></h1>
</div>

<div class="content-panel">
    <form id="post-form" class="admin-form" action="/admin/posts" method="POST" enctype="multipart/form-data">
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
            <label for="body">İçerik</label>
            <div id="editor" style="min-height: 250px;"><?= $_POST['body'] ?? '' ?></div>
            <input type="hidden" name="body" id="body-content">
        </div>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" class="button button-primary">
                <i data-lucide="save"></i>
                <span>Kaydet</span>
            </button>
        </div>
    </form>
</div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>