<?php require(BASE_PATH . '/templates/partials/header.php'); ?>

<?php
// Gerekli sınıfları burada da çağırıyoruz
require_once BASE_PATH . '/core/ReadingTime.php';
require_once BASE_PATH . '/core/AiTranslate.php';
?>

<?php // Sol tarafta boş bir alan bırakmak için (içindekiler menüsü buraya JS ile geliyor) ?>
<aside class="post-sidebar-left"></aside>

<?php // Ana içerik alanı ?>
<main class="container">
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
            $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
            echo AiTranslate::generateButtons($post['title'], $post['slug'], $baseUrl);
            ?>
        </header>

        <div class="post-content">
            <?= $post['body'] ?>
        </div>
    </article>
</main>

<?php // Sağ sidebar ?>
<aside class="post-sidebar-right">
   <div class="sidebar-widget">
    <h3 class="widget-title">Kategoriler</h3>
    <?php if (!empty($categories)): ?>
        <ul class="category-list">
            <?php foreach ($categories as $category): ?>
                <li><a href="/category/<?= htmlspecialchars($category['slug']) ?>"><?= htmlspecialchars($category['name']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
    <div class="sidebar-widget">
        <h3 class="widget-title">Paylaş</h3>
       <div class="share-buttons">
    <a href="#" target="_blank" class="share-btn" aria-label="X üzerinde paylaş">
        <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
    </a>
    <a href="#" target="_blank" class="share-btn" aria-label="LinkedIn üzerinde paylaş">
    <svg viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
    </a>
    <a href="#" target="_blank" class="share-btn" aria-label="WhatsApp üzerinde paylaş">
        <svg viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zM12.04 20.15c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31c-.82-1.31-1.26-2.83-1.26-4.39 0-4.54 3.7-8.24 8.24-8.24 2.2 0 4.27.86 5.82 2.42 1.56 1.56 2.42 3.62 2.42 5.83-.01 4.54-3.7 8.24-8.23 8.24zm4.52-6.16c-.25-.12-1.47-.72-1.7-.82-.23-.09-.39-.12-.56.12-.17.25-.64.82-.79.99-.15.17-.29.19-.54.06-.25-.12-1.06-.39-2.02-1.25-.74-.66-1.24-1.47-1.38-1.72-.14-.25-.01-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.84-.2-.48-.41-.42-.56-.42h-.5c-.17 0-.43.06-.66.31-.22.25-.86.85-.86 2.07 0 1.22.88 2.4 1 2.56.12.17 1.73 2.63 4.2 3.7.59.25 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.07-.12-.22-.19-.47-.31z"/></svg>
    </a>
</div>
    </div>
</aside>

<?php require(BASE_PATH . '/templates/partials/footer.php'); ?>