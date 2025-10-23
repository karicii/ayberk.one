<?php require BASE_PATH . '/templates/partials/header.php'; ?>

<div class="content-block">
    <div class="search-page-header">
        <h1>Arama</h1>
        <form action="/search" method="GET" class="search-form">
            <input 
                type="text" 
                name="q" 
                value="<?= htmlspecialchars($query) ?>" 
                placeholder="Yazı başlığı veya içerik ara..." 
                autofocus
                minlength="3"
                required
            >
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>
        </form>
    </div>

    <?php if ($tooShort): ?>
        <div class="search-notice">
            <p>⚠️ Arama için en az 3 karakter girmelisiniz.</p>
        </div>
    <?php elseif ($searchPerformed): ?>
        <div class="search-results-info">
            <p>"<strong><?= htmlspecialchars($query) ?></strong>" için <strong><?= count($results) ?></strong> sonuç bulundu</p>
        </div>

        <?php if (empty($results)): ?>
            <div class="search-empty">
                <p>Aramanız için sonuç bulunamadı. Farklı kelimeler deneyin.</p>
            </div>
        <?php else: ?>
            <ul class="post-list">
                <?php foreach ($results as $post): ?>
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
                                <h3 class="post-list-title"><?= htmlspecialchars($post['title']) ?></h3>
                                <div class="post-list-meta">
                                    <time datetime="<?= date('Y-m-d', strtotime($post['created_at'])) ?>">
                                        <?= date('d M Y', strtotime($post['created_at'])) ?>
                                    </time>
                                    <?php if (!empty($post['category_name'])): ?>
                                        <span class="separator">•</span>
                                        <span><?= htmlspecialchars($post['category_name']) ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($post['reading_time'])): ?>
                                        <span class="separator">•</span>
                                        <span><?= $post['reading_time'] ?> dk okuma</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require BASE_PATH . '/templates/partials/footer.php'; ?>
