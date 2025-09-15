<?php require(BASE_PATH . '/templates/partials/admin_header.php'); ?>

<div class="content-header">
    <h1>Gelen Mesajlar</h1>
</div>

<div class="content-panel">
    <?php if (isset($_SESSION['success_message'])) : ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message'] ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <div class="message-inbox">
        <?php if (empty($messages)) : ?>
            <p class="empty-state">Gelen kutunuzda hiç mesaj yok.</p>
        <?php else : ?>
            <?php foreach ($messages as $message) : ?>
                <a href="/admin/messages/<?= $message['id'] ?>" class="message-item">
                    <div class="message-sender">
                        <i data-lucide="user-circle"></i>
                        <span><?= htmlspecialchars($message['name']) ?></span>
                    </div>
                    <div class="message-snippet"><?= htmlspecialchars(substr($message['message'], 0, 80)) . '...' ?></div>
                    <div class="message-date"><?= date('d M Y, H:i', strtotime($message['created_at'])) ?></div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php'); ?>