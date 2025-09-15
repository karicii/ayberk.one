<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

<div class="content-header">
    <h1>İstatistikler</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i data-lucide="file-text"></i></div>
        <div class="stat-content">
            <span class="stat-number"><?= $totalPosts ?? 0 ?></span>
            <span class="stat-title">Toplam Yazı</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i data-lucide="eye"></i></div>
        <div class="stat-content">
            <span class="stat-number"><?= $totalViews ?? 0 ?></span>
            <span class="stat-title">Toplam Görüntülenme</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i data-lucide="inbox"></i></div>
        <div class="stat-content">
            <span class="stat-number"><?= $totalMessages ?? 0 ?></span>
            <span class="stat-title">Toplam Mesaj</span>
        </div>
    </div>
</div>

<div class="lists-grid">
    <div class="content-panel">
        <h3 class="panel-header">En Popüler Yazılar</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Görüntülenme</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($popularPosts)): ?>
                    <?php foreach ($popularPosts as $post): ?>
                        <tr>
                            <td><a href="/posts/<?= $post['slug'] ?>" target="_blank"><?= htmlspecialchars($post['title']) ?></a></td>
                            <td><?= $post['view_count'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center empty-state">Henüz hiç yazı görüntülenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="content-panel">
        <h3 class="panel-header">Son Gelen Mesajlar</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gönderen</th>
                    <th>Konu</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recentMessages)): ?>
                    <?php foreach ($recentMessages as $message): ?>
                        <tr>
                            <td><?= htmlspecialchars($message['name']) ?></td>
                            <td><a href="/admin/messages/<?= $message['id'] ?>"><?= htmlspecialchars($message['subject']) ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center empty-state">Henüz hiç mesaj yok.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>