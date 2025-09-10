<?php require(BASE_PATH . '/templates/partials/header.php') ?>

<?php /* ReadingTime sınıfını dahil et */ ?>
<?php require_once BASE_PATH . '/core/ReadingTime.php'; ?>
<?php require_once BASE_PATH . '/core/AiTranslate.php'; ?>

<?php /* İçindekiler tablosu doğrudan body içinde, container dışında */ ?>

<div class="post-layout">
    <div class="post-main">
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
                <p class="reading-time-meta">
                    Okuma Süresi: <?= isset($post['reading_time']) ? $post['reading_time'] . ' dakika' : '1 dakika' ?>
                </p>
                
                <?php 
                // AI Çeviri ve Özetleme Butonları - Okuma süresi altında
                $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
                echo AiTranslate::generateButtons($post['title'], $post['slug'], $baseUrl);
                ?>
            </header>                                                   

            <div class="post-content">
                <?= $post['body'] ?>
            </div>
        </article>
    </div>
</div>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>