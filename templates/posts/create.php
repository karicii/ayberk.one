<?php require(BASE_PATH . '/templates/partials/header.php') ?>

<div class="container">
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

    <form action="/admin/posts" method="POST">
        <div>
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" value="<?= $_POST['title'] ?? '' ?>">
        </div>
        <div>
            <label for="body">İçerik</label>
            <textarea id="body" name="body"><?= $_POST['body'] ?? '' ?></textarea>
        </div>
        <div>
            <button type="submit">Kaydet</button>
        </div>
    </form>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>