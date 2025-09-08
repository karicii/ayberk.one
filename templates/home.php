<?php require(BASE_PATH . '/templates/partials/header.php') ?>

    <div class="content-block">
        <h2>Son Yazılar</h2>
        
        <?php if (!empty($latestPosts)): ?>
            <ul class="post-list">
                <?php foreach ($latestPosts as $post): ?>
                    <li>
                        <a href="/posts/<?= htmlspecialchars($post['slug']) ?>">
                            <h3><?= htmlspecialchars($post['title']) ?></h3>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Henüz hiç yazı eklenmemiş.</p>
        <?php endif; ?>
    </div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>