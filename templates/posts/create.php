<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <h1><?= $pageTitle ?></h1>

    <form id="post-form" class="admin-form" action="/admin/posts" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> <div class="form-group">
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= $_POST['title'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="post_image">Kapak Görseli</label>
            <input type="file" id="post_image" name="post_image">
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

        <div class="form-group">
            <button type="submit" class="button button-primary">Kaydet</button>
        </div>
    </form>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>