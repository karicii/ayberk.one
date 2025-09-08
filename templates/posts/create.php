<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <h1><?= $pageTitle ?></h1>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="admin-form" action="/admin/posts" method="POST">
        <div class="form-group">
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= $_POST['title'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="body">İçerik</label>
            <textarea id="body" name="body" rows="10"><?= $_POST['body'] ?? '' ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Kaydet</button>
        </div>
    </form>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>