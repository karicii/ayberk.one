<?php require(BASE_PATH . '/templates/partials/admin_header.php'); ?>

<div class="message-view">
    <div class="message-view-header">
        <h1 class="message-subject">Gönderen: <?= htmlspecialchars($message['name']) ?></h1>
        <a href="/admin/messages" class="button">&larr; Gelen Kutusuna Dön</a>
    </div>
    
    <div class="message-meta">
        <div class="meta-item">
            <strong>E-posta:</strong>
            <span><?= htmlspecialchars($message['email']) ?></span>
        </div>
        <div class="meta-item">
            <strong>Tarih:</strong>
            <span><?= date('d F Y, H:i', strtotime($message['created_at'])) ?></span>
        </div>
        <div class="meta-item">
            <strong>IP Adresi:</strong>
            <span><?= htmlspecialchars($message['ip_address']) ?></span>
        </div>
        <div class="meta-item">
            <strong>User Agent:</strong>
            <span class="user-agent"><?= htmlspecialchars($message['user_agent']) ?></span>
        </div>
    </div>
    
    <div class="message-body">
        <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>
    </div>

    <div class="message-actions">
        <form action="/admin/messages/delete" method="POST" onsubmit="return confirm('Bu mesajı kalıcı olarak silmek istediğinizden emin misiniz?');">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="id" value="<?= $message['id']; ?>">
            <button type="submit" class="button button-delete">Bu Mesajı Sil</button>
        </form>
    </div>
</div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php'); ?>