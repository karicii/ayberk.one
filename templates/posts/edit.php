<?php require(BASE_PATH . '/templates/partials/header.php') ?>

<div class="container">
    <h1><?= $pageTitle ?></h1>

    <form action="/admin/posts/<?= $post['id'] ?>" method="POST">
        <input type="hidden" name="_method" value="PATCH">
        
        <div>
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title'] ?? '') ?>">
        </div>
        <div>
            <label for="body">İçerik</label>
            <textarea id="body" name="body"><?= htmlspecialchars($post['body'] ?? '') ?></textarea>
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

        <div>
            <button type="submit">Güncelle</button>
        </div>
    </form>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>