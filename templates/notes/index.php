<?php require BASE_PATH . '/templates/partials/header.php'; ?>

<div class="notes-container">
    <div class="notes-header">
        <h1><?= t('notes_title') ?></h1>
        <p><?= t('notes_subtitle') ?></p>
    </div>

    <?php if (!empty($categories)): ?>
        <div class="notes-categories">
            <a href="/notes" class="category-pill <?= !$category ? 'active' : '' ?>">
                <?= t('all') ?>
            </a>
            <?php foreach ($categories as $cat): ?>
                <a href="/notes?category=<?= urlencode($cat['category']) ?>" class="category-pill <?= $category === $cat['category'] ? 'active' : '' ?>">
                    <?= htmlspecialchars($cat['category']) ?> (<?= $cat['count'] ?>)
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($notes)): ?>
        <div class="notes-empty">
            <p><?= t('no_notes') ?></p>
        </div>
    <?php else: ?>
        <div class="notes-list">
            <?php foreach ($notes as $note): ?>
                <article class="note-card">
                    <div class="note-header">
                        <h2 class="note-title">
                            <a href="/notes/<?= htmlspecialchars($note['slug']) ?>">
                                <?= htmlspecialchars($note['title']) ?>
                            </a>
                        </h2>
                        <div class="note-meta">
                            <time datetime="<?= $note['created_at'] ?>">
                                <?= date('d M Y', strtotime($note['created_at'])) ?>
                            </time>
                            <?php if ($note['category']): ?>
                                <span class="separator">•</span>
                                <span class="note-category"><?= htmlspecialchars($note['category']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="note-content">
                        <?= nl2br(htmlspecialchars(mb_substr(strip_tags($note['content']), 0, 200))) ?><?= mb_strlen(strip_tags($note['content'])) > 200 ? '...' : '' ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require BASE_PATH . '/templates/partials/footer.php'; ?>
