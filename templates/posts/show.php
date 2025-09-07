<?php require(BASE_PATH . '/templates/partials/header.php') ?>

<div class="container">
    <article>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div>
            <?= $post['body'] // Yazı içeriği veritabanına güvenli HTML olarak kaydedildiyse bu şekilde basılabilir. Aksi halde htmlspecialchars() kullanılmalı. ?>
        </div>
    </article>
    <a href="/">Geri dön</a>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>