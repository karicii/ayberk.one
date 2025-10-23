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
        <h1>Kategori Yönetimi</h1>
        <a href="/admin/categories/create" class="button button-primary">
            <i data-lucide="plus-circle"></i>
            <span>Yeni Kategori Ekle</span>
        </a>
    </div>

    <div class="content-panel">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Kategori Adı</th>
                    <th>Slug</th>
                    <th class="actions-header">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category['name']) ?></td>
                            <td><code><?= htmlspecialchars($category['slug']) ?></code></td>
                            <td class="actions">
                                <a href="/category/<?= $category['slug'] ?>" target="_blank" class="button" title="Görüntüle">
                                    <i data-lucide="eye"></i>
                                    <span>Görüntüle</span>
                                </a>
                                <a href="/admin/categories/edit/<?= $category['id'] ?>" class="button" title="Düzenle">
                                    <i data-lucide="file-pen-line"></i>
                                    <span>Düzenle</span>
                                </a>
                                <form method="POST" action="/admin/categories/<?= $category['id'] ?>" style="display: inline;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                    <button type="submit" class="button button-delete" title="Sil" onclick="return confirm('Bu kategoriyi silmek istediğinizden emin misiniz?')">
                                        <i data-lucide="trash-2"></i>
                                        <span>Sil</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center empty-state">Henüz hiç kategori eklenmemiş.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php require(BASE_PATH . '/templates/partials/admin_footer.php') ?>
