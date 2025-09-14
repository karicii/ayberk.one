<?php require(BASE_PATH . '/templates/partials/header.php'); ?>

<?php
// Gerekli sınıfları burada da çağırıyoruz
require_once BASE_PATH . '/core/ReadingTime.php';
require_once BASE_PATH . '/core/AiTranslate.php';
?>

<?php // --- ÖNEMLİ DÜZELTME BAŞLANGICI --- ?>
<?php // Header'dan gelen dar .container ve .site-content'i burada kapatıyoruz ?>
</main>
</div>
<?php // --- ÖNEMLİ DÜZELTME SONU --- ?>


<div class="post-layout-container">
    
    <aside class="post-sidebar-left">
        </aside>

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

    <aside class="post-sidebar-right">
        <div class="sidebar-widget">
            <h3 class="widget-title">Kategoriler</h3>
            <ul class="category-list">
                <li><a href="#">Yazılım Geliştirme</a></li>
                <li><a href="#">Web Tasarım</a></li>
            </ul>
        </div>
        <div class="sidebar-widget">
            <h3 class="widget-title">Paylaş</h3>
            <div class="share-buttons">
                <a href="#" target="_blank" class="share-btn x">X</a>
                <a href="#" target="_blank" class="share-btn linkedin">LinkedIn</a>
                <a href="#" target="_blank" class="share-btn whatsapp">WhatsApp</a>
            </div>
        </div>
    </aside>

</div>

<?php // --- ÖNEMLİ DÜZELTME BAŞLANGICI --- ?>
<?php // Footer.php'nin hata vermemesi için kapattığımız etiketleri burada yeniden açıyoruz ki footer onları kapatabilsin. ?>
<div class="container" style="display: none;">
<main class="site-content" style="display: none;">
<?php // --- ÖNEMLİ DÜZELTME SONU --- ?>


<?php require(BASE_PATH . '/templates/partials/footer.php'); ?>