<?php require(BASE_PATH . '/templates/partials/header.php') ?>

    <article class="post">
        <header class="post-header">
            <?php if (!empty($post['image_path'])): ?>
                <div class="post-featured-image-container">
                    <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="post-featured-image">
                </div>
            <?php endif; ?>
            <h1 class="post-title"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="post-meta">
                Yayınlanma Tarihi: 
                <time datetime="<?= date('Y-m-d', strtotime($post['created_at'])) ?>">
                    <?= date('d F Y', strtotime($post['created_at'])) ?>
                </time>
            </p>
        </header>

        <div class="post-content">
            <?= $post['body'] ?>
        </div>
    </article>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>