<?php require BASE_PATH . '/templates/admin/partials/header.php'; ?>

<div class="admin-header">
    <h1>📧 Bülten Aboneleri</h1>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Toplam Abone</div>
        <div class="stat-value"><?= $stats['total'] ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Aktif Abone</div>
        <div class="stat-value stat-success"><?= $stats['active'] ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Abonelikten Çıkan</div>
        <div class="stat-value stat-muted"><?= $stats['unsubscribed'] ?></div>
    </div>
</div>

<?php if (empty($subscribers)): ?>
    <div class="empty-state">
        <p>Henüz hiç abone bulunmuyor.</p>
    </div>
<?php else: ?>
    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 25%">E-posta</th>
                    <th style="width: 15%">Durum</th>
                    <th style="width: 15%">Abone Tarihi</th>
                    <th style="width: 15%">IP Adresi</th>
                    <th style="width: 25%">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscribers as $subscriber): ?>
                    <tr>
                        <td><?= $subscriber['id'] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($subscriber['email']) ?></strong>
                            <?php if ($subscriber['name']): ?>
                                <br><small><?= htmlspecialchars($subscriber['name']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($subscriber['status'] === 'active'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-muted">Abonelikten Çıktı</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <time datetime="<?= $subscriber['subscribed_at'] ?>">
                                <?= date('d.m.Y H:i', strtotime($subscriber['subscribed_at'])) ?>
                            </time>
                            <?php if ($subscriber['unsubscribed_at']): ?>
                                <br><small class="text-muted">Çıkış: <?= date('d.m.Y', strtotime($subscriber['unsubscribed_at'])) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <small class="text-muted"><?= htmlspecialchars($subscriber['ip_address'] ?? 'N/A') ?></small>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <?php if ($subscriber['status'] === 'unsubscribed'): ?>
                                    <form method="POST" action="/admin/newsletter/reactivate" style="display:inline;">
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="id" value="<?= $subscriber['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-success">Yeniden Aktif Et</button>
                                    </form>
                                <?php endif; ?>
                                <form method="POST" action="/admin/newsletter/delete" style="display:inline;" onsubmit="return confirm('Bu aboneyi silmek istediğinizden emin misiniz?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <input type="hidden" name="id" value="<?= $subscriber['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require BASE_PATH . '/templates/admin/partials/footer.php'; ?>
