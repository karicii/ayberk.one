<?php require(BASE_PATH . '/templates/partials/header.php') ?>

<div class="archive-header">
    <div class="breadcrumb">
        <a href="/">Ana Sayfa</a>
        <span>/</span>
        <span>Arşiv</span>
        <?php if ($year): ?>
            <span>/</span>
            <span><?= $year ?></span>
        <?php endif; ?>
        <?php if ($month): ?>
            <span>/</span>
            <span><?= date('F', mktime(0, 0, 0, $month, 1)) ?></span>
        <?php endif; ?>
    </div>
    <h1><?= $title ?></h1>
    <p class="archive-count"><?= count($posts) ?> yazı bulundu</p>
</div>

<div class="archive-container">
    <!-- Sol: Yazı Listesi -->
    <div class="archive-posts">
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
                <p>Bu dönemde hiç yazı yok.</p>
                <a href="/arsiv" class="button">Tüm Arşive Dön</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Sağ: Arşiv Listesi -->
    <aside class="archive-sidebar">
        <div class="sidebar-widget">
            <h3 class="widget-title">Dönemlere Göre</h3>
            <?php if (!empty($archive)): ?>
                <ul class="archive-list">
                    <?php 
                    $currentYear = null;
                    foreach ($archive as $item): 
                        // Yıl değiştiğinde başlık ekle
                        if ($currentYear !== $item['year']):
                            if ($currentYear !== null): ?>
                                </ul></li>
                            <?php endif; ?>
                            <li class="archive-year">
                                <a href="/arsiv/<?= $item['year'] ?>" class="year-link">
                                    <?= $item['year'] ?>
                                </a>
                                <ul class="archive-months">
                            <?php $currentYear = $item['year']; ?>
                        <?php endif; ?>
                        
                        <li>
                            <a href="/arsiv/<?= $item['year'] ?>/<?= str_pad($item['month'], 2, '0', STR_PAD_LEFT) ?>">
                                <?= date('F', mktime(0, 0, 0, $item['month'], 1)) ?>
                                <span class="count">(<?= $item['count'] ?>)</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <?php if ($currentYear !== null): ?>
                        </ul></li>
                    <?php endif; ?>
                </ul>
            <?php else: ?>
                <p>Henüz arşiv yok.</p>
            <?php endif; ?>
        </div>
    </aside>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>
