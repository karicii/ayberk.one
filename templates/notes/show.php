<?php require BASE_PATH . '/templates/partials/header.php'; ?>

<div class="note-detail">
    <header class="note-detail-header">
        <div class="note-breadcrumb">
            <a href="/notes">← Notlar</a>
            <?php if ($note['category']): ?>
                <span class="separator">/</span>
                <a href="/notes?category=<?= urlencode($note['category']) ?>"><?= htmlspecialchars($note['category']) ?></a>
            <?php endif; ?>
        </div>
        
        <h1><?= htmlspecialchars($note['title']) ?></h1>
        
        <div class="note-detail-meta">
            <time datetime="<?= $note['created_at'] ?>">
                <?= date('d M Y', strtotime($note['created_at'])) ?>
            </time>
            <?php if ($note['category']): ?>
                <span class="separator">•</span>
                <span><?= htmlspecialchars($note['category']) ?></span>
            <?php endif; ?>
            <span class="separator">•</span>
            <span><?= $note['view_count'] ?> görüntülenme</span>
        </div>
    </header>

    <div class="note-detail-content">
        <?= nl2br(htmlspecialchars($note['content'])) ?>
    </div>
</div>

<?php require BASE_PATH . '/templates/partials/footer.php'; ?>
