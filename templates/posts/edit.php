<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <h1><?= $pageTitle ?></h1>

    <form class="admin-form" action="/admin/posts/<?= $post['id'] ?>" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        
        <div class="form-group">
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="body">İçerik</label>
            <textarea id="body" name="body" rows="10"><?= htmlspecialchars($post['body'] ?? '') ?></textarea>
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
            <button type="submit">Güncelle</button>
        </div>
    </form>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>