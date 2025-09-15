<?php require(BASE_PATH . '/templates/partials/header.php'); ?>

<div class="content-block">
    
    <div class="category-header">
        <span class="category-header-subtitle">Kategori</span>
        <h1 class="category-header-title"><?= htmlspecialchars($category['name']) ?></h1>
    </div>

    <?php if (!empty($posts)): ?>
        <ul class="post-list">
            <?php foreach ($posts as $post): ?>
                <li>
                    <a href="/posts/<?= htmlspecialchars($post['slug']) ?>" class="post-list-item">
                        <div class="post-list-image-container">
                            <?php if (!empty($post['image_path'])): ?>
                                <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="post-list-image">
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
        <p>Bu kategoride henüz hiç yazı bulunmuyor.</p>
    <?php endif; ?>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php'); ?>