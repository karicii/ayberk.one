<?php require(BASE_PATH . '/templates/partials/header.php'); ?>

<div class="content-block">
    <h2>Son Yazılar</h2>
    
    <?php if (!empty($latestPosts)): ?>
        <ul class="post-list">
            <?php foreach ($latestPosts as $post): ?>
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
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Henüz hiç yazı eklenmemiş.</p>
    <?php endif; ?>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php'); ?>