<?php require(BASE_PATH . '/templates/partials/admin_header.php') ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="content-header">
        <h1>Etiket Yönetimi</h1>
        <a href="/admin/tags/create" class="button button-primary">
            <i data-lucide="tag"></i>
            <span>Yeni Etiket Ekle</span>
        </a>
    </div>

    <div class="content-panel">
        <table class="admin-table tags-table">
            <thead>
                <tr>
                    <th>Etiket Adı</th>
                    <th>Slug</th>
                    <th>Açıklama</th>
                    <th>Yazı Sayısı</th>
                    <th class="actions-header">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tags)): ?>
                    <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($tag['name']) ?></strong></td>
                            <td><code><?= htmlspecialchars($tag['slug']) ?></code></td>
                            <td><?= $tag['description'] ? htmlspecialchars(substr($tag['description'], 0, 60)) . '...' : '-' ?></td>
                            <td><span class="badge"><?= $tag['post_count'] ?? 0 ?></span></td>
                            <td class="actions">
                                <a href="/tag/<?= $tag['slug'] ?>" target="_blank" class="button" title="Görüntüle">
                                    <i data-lucide="eye"></i>
                                    <span>Görüntüle</span>
                                </a>
                                <a href="/admin/tags/edit/<?= $tag['id'] ?>" class="button" title="Düzenle">
                                    <i data-lucide="file-pen-line"></i>
                                    <span>Düzenle</span>
                                </a>
                                <form method="POST" action="/admin/tags/<?= $tag['id'] ?>" style="display: inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <button type="submit" class="button button-delete" title="Sil" onclick="return confirm('Bu etiketi silmek istediğinizden emin misiniz?')">
                                        <i data-lucide="trash-2"></i>
                                        <span>Sil</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center empty-state">Henüz hiç etiket eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>
