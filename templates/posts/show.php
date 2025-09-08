<?php require(BASE_PATH . '/templates/partials/header.php') ?>

    <article class="post">
        <header class="post-header">
            <h1 class="post-title"><?= htmlspecialchars($post['title']) ?></h1>
            <p class="post-meta">
                Yayınlanma Tarihi: 
                <time datetime="<?= date('Y-m-d', strtotime($post['created_at'])) ?>">
                    <?= date('d F Y', strtotime($post['created_at'])) ?>
                </time>
            </p>
        </header>

        <div class="post-content">
            <?php // Buraya veritabanından gelen asıl yazı içeriği gelecek.
                  // Şimdilik daha zengin bir görünüm için örnek içerik ekleyelim. ?>
            <p>Bu, makalenin giriş paragrafıdır. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.</p>
            <h2>Alt Başlık</h2>
            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
            <pre><code>&lt;?php
function greet(string $name): string {
    return "Merhaba, " . $name;
}
?&gt;</code></pre>
            <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.</p>
        </div>
    </article>

<?php require(BASE_PATH . '/templates/partials/footer.php') ?>