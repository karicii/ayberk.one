<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <div class="content-header">
        <h1>Yazı Yönetimi</h1>
        <a href="/admin/posts/create" class="button button-primary">
            <i data-lucide="plus-circle"></i>
            <span>Yeni Yazı Ekle</span>
        </a>
    </div>

    <div class="content-panel">
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
                                <a href="/posts/<?= $post['slug'] ?>" target="_blank" class="button" title="Görüntüle"><i data-lucide="eye"></i></a>
                                <a href="/admin/posts/edit/<?= $post['id'] ?>" class="button" title="Düzenle"><i data-lucide="file-pen-line"></i></a>
                                <form method="POST" action="/admin/posts/<?= $post['id'] ?>" style="display: inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <button type="submit" class="button button-delete" title="Sil" onclick="return confirm('Bu yazıyı silmek istediğinizden emin misiniz?')"><i data-lucide="trash-2"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty-state">Henüz hiç yazı eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>