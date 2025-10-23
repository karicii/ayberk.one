<?php require BASE_PATH . '/templates/partials/header.php'; ?>

<div class="search-page">
    <div class="search-header">
        <h1>Arama</h1>
        <form action="/search" method="GET" class="search-form-main">
            <div class="search-input-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input 
                    type="text" 
                    name="q" 
                    value="<?= htmlspecialchars($query) ?>" 
                    placeholder="Başlık, içerik, kategori veya etiket ara..." 
                    autofocus
                    required
                >
                <button type="submit">Ara</button>
            </div>
        </form>
    </div>

    <?php if ($searchPerformed): ?>
        <div class="search-results">
            <p class="search-meta">
                <strong>"<?= htmlspecialchars($query) ?>"</strong> için 
                <strong><?= count($results) ?></strong> sonuç bulundu
            </p>

            <?php if (empty($results)): ?>
                <div class="no-results">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                        <line x1="11" y1="8" x2="11" y2="14"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                    <h2>Sonuç bulunamadı</h2>
                    <p>Farklı anahtar kelimeler deneyebilir veya yazım hatası kontrol edebilirsiniz.</p>
                </div>
            <?php else: ?>
                <div class="post-list">
                    <?php foreach ($results as $post): ?>
                        <article class="post-card">
                            <?php if (!empty($post['image_path'])): ?>
                                <a href="/posts/<?= htmlspecialchars($post['slug']) ?>" class="post-image">
                                    <img src="<?= htmlspecialchars($post['image_path']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                                </a>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <div class="post-meta">
                                    <time datetime="<?= date('Y-m-d', strtotime($post['published_at'])) ?>">
                                        <?= date('d M Y', strtotime($post['published_at'])) ?>
                                    </time>
                                    <?php if (!empty($post['category_name'])): ?>
                                        <span class="separator">•</span>
                                        <a href="/category/<?= htmlspecialchars($post['category_slug']) ?>" class="category-link">
                                            <?= htmlspecialchars($post['category_name']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                
                                <h2 class="post-title">
                                    <a href="/posts/<?= htmlspecialchars($post['slug']) ?>">
                                        <?= htmlspecialchars($post['title']) ?>
                                    </a>
                                </h2>
                                
                                <?php if (!empty($post['excerpt'])): ?>
                                    <p class="post-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
                                <?php endif; ?>
                                
                                <?php if (!empty($post['tags'])): ?>
                                    <div class="post-tags">
                                        <?php 
                                        $tagNames = explode(', ', $post['tags']);
                                        foreach ($tagNames as $tagName): 
                                        ?>
                                            <span class="tag-badge"><?= htmlspecialchars($tagName) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="search-tips">
            <h2>Arama İpuçları</h2>
            <ul>
                <li>Yazı başlıklarında, içerikte, kategorilerde ve etiketlerde arama yapabilirsiniz</li>
                <li>En alakalı sonuçlar önce gösterilir</li>
                <li>Tam eşleşmeler daha yüksek önceliğe sahiptir</li>
                <li>Birden fazla kelime için boşluk kullanabilirsiniz</li>
            </ul>
        </div>
    <?php endif; ?>
</div>

<?php require BASE_PATH . '/templates/partials/footer.php'; ?>
