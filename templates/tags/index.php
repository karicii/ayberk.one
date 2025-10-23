<?php require(BASE_PATH . '/templates/partials/header.php') ?>

    <section class="tags-hero">
        <h1>Tüm Etiketler</h1>
        <p>İlgilendiğin konulara göre yazıları keşfet</p>
    </section>

    <section class="tags-grid">
        <?php if (!empty($tags)): ?>
            <?php foreach ($tags as $tag): ?>
                <a href="/tag/<?= htmlspecialchars($tag['slug']) ?>" class="tag-card">
                    <div class="tag-card-header">
                        <h3><?= htmlspecialchars($tag['name']) ?></h3>
                        <span class="tag-count"><?= $tag['post_count'] ?? 0 ?> yazı</span>
                    </div>
                    <?php if (!empty($tag['description'])): ?>
                        <p class="tag-description"><?= htmlspecialchars($tag['description']) ?></p>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>Henüz hiç etiket eklenmemiş.</p>
            </div>
        <?php endif; ?>
    </section>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>
