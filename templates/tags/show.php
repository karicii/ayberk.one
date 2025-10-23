<?php require(BASE_PATH . '/templates/partials/header.php') ?>

    <section class="tag-header">
        <div class="tag-info">
            <div class="breadcrumb">
                <a href="/">Ana Sayfa</a>
                <span>/</span>
                <span><?= htmlspecialchars($tag['name']) ?></span>
            </div>
            <h1><?= htmlspecialchars($tag['name']) ?></h1>
            <?php if (!empty($tag['description'])): ?>
                <p class="tag-description"><?= htmlspecialchars($tag['description']) ?></p>
            <?php endif; ?>
            <div class="tag-meta">
                <span><?= count($posts) ?> yazı</span>
            </div>
        </div>
    </section>

    <div class="content-block">
        <?php if (!empty($posts)): ?>
            <ul class="post-list">
                <?php foreach ($posts as $post): ?>
                    <li>
                        <a href="/posts/<?= htmlspecialchars($post['slug']) ?>" class="post-list-item">
                            <div class="post-list-image-container">
                                <?php if (!empty($post['image_path'])): ?>
                                    <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="post-list-image">
                                <?php else: ?>
                                    <div class="post-list-image-placeholder"></div>
                                <?php endif; ?>
                            </div>
                            <div class="post-list-content">
                                <h3><?= htmlspecialchars($post['title']) ?></h3>
                                <div class="post-meta">
                                    <time datetime="<?= $post['created_at'] ?>">
                                        <?= date('d M Y', strtotime($post['created_at'])) ?>
                                    </time>
                                    <?php if ($post['reading_time'] > 0): ?>
                                        <span>•</span>
                                        <span><?= $post['reading_time'] ?> dk okuma</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-state">
                <p>Bu etiketle henüz yazı yok.</p>
                <a href="/" class="button">Ana Sayfaya Dön</a>
            </div>
        <?php endif; ?>
    </div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>
