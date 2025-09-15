<?php require(BASE_PATH . '/templates/partials/admin_header.php'); ?>

<div class="content-header">
    <h1>Mesaj Detayı</h1>
    <a href="/admin/messages" class="button">
        <i data-lucide="arrow-left"></i>
        <span>Gelen Kutusuna Dön</span>
    </a>
</div>

<div class="content-panel message-view">
    <div class="message-view-header">
        <h2 class="message-subject">Gönderen: <?= htmlspecialchars($message['name']) ?></h2>
    </div>
    
    <div class="message-meta">
        <div class="meta-item">
            <strong><i data-lucide="at-sign"></i> E-posta:</strong>
            <span><?= htmlspecialchars($message['email']) ?></span>
        </div>
        <div class="meta-item">
            <strong><i data-lucide="calendar"></i> Tarih:</strong>
            <span><?= date('d F Y, H:i', strtotime($message['created_at'])) ?></span>
        </div>
        <div class="meta-item">
            <strong><i data-lucide="hard-drive"></i> IP Adresi:</strong>
            <span><?= htmlspecialchars($message['ip_address']) ?></span>
        </div>
        <div class="meta-item">
            <strong><i data-lucide="smartphone"></i> User Agent:</strong>
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
            <button type="submit" class="button button-delete">
                <i data-lucide="trash-2"></i>
                <span>Bu Mesajı Sil</span>
            </button>
        </form>
    </div>
</div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php'); ?>