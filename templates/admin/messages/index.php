<?php require base_path('templates/partials/admin_header.php'); ?>

<div class="admin-container">
    <div class="admin-header">
        <h1>Gelen Mesajlar</h1>
    </div>

    <?php if (isset($_SESSION['success_message'])) : ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_message'] ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (empty($messages)) : ?>
        <p>Henüz gelen bir mesaj yok.</p>
    <?php else : ?>
        <table class="messages-table">
            <thead>
                <tr>
                    <th>Gönderen</th>
                    <th>E-posta</th>
                    <th>Mesaj</th>
                    <th>Tarih</th>
                    <th>IP Adresi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td><?= htmlspecialchars($message['name']) ?></td>
                        <td><?= htmlspecialchars($message['email']) ?></td>
                        <td><?= nl2br(htmlspecialchars($message['message'])) ?></td>
                        <td><?= date('d.m.Y H:i', strtotime($message['created_at'])) ?></td>
                        <td><?= htmlspecialchars($message['ip_address']) ?></td>
                        <td>
                             <form action="/admin/messages/delete" method="POST" onsubmit="return confirm('Bu mesajı silmek istediğinizden emin misiniz?');">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="id" value="<?= $message['id']; ?>">
                                <button type="submit" class="delete-btn">Sil</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<?php require base_path('templates/partials/admin_footer.php'); ?>