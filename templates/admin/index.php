<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Yazı Yönetimi</h1>
        <a href="/admin/posts/create" class="button button-primary">Yeni Yazı Ekle</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Başlık</th>
                <th>Tarih</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                        <td class="actions">
                            <a href="/posts/<?= $post['slug'] ?>" target="_blank" class="button">Görüntüle</a>
                            <a href="/admin/posts/edit/<?= $post['id'] ?>" class="button">Düzenle</a>
                            <form method="POST" action="/admin/posts/<?= $post['id'] ?>" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> <button type="submit" class="button button-delete" onclick="return confirm('Bu yazıyı silmek istediğinizden emin misiniz?')">Sil</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem;">Henüz hiç yazı eklenmemiş.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>