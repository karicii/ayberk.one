<?php require BASE_PATH . '/templates/partials/admin_header.php'; ?>

<div class="content-header">
    <h1>📝 Not Yönetimi</h1>
    <a href="/admin/notes/create" class="button button-primary">
        <i data-lucide="plus-circle"></i>
        <span>Yeni Not Ekle</span>
    </a>
</div>

<?php if (empty($notes)): ?>
    <div class="empty-state">
        <p>Henüz not eklenmemiş.</p>
    </div>
<?php else: ?>
    <div class="content-panel">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 40%">Başlık</th>
                    <th style="width: 15%">Kategori</th>
                    <th style="width: 10%">Durum</th>
                    <th style="width: 15%">Tarih</th>
                    <th class="actions-header" style="width: 20%">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note): ?>
                    <tr>
                        <td><?= htmlspecialchars($note['title']) ?></td>
                        <td>
                            <?= $note['category'] ? '<span class="badge">' . htmlspecialchars($note['category']) . '</span>' : '-' ?>
                        </td>
                        <td>
                            <?php if ($note['is_published']): ?>
                                <span class="badge badge-success">Yayında</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Taslak</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d M Y', strtotime($note['created_at'])) ?></td>
                        <td class="actions">
                            <a href="/notes/<?= $note['slug'] ?>" target="_blank" class="button" title="Görüntüle">
                                <i data-lucide="eye"></i>
                                <span>Görüntüle</span>
                            </a>
                            <a href="/admin/notes/edit/<?= $note['id'] ?>" class="button" title="Düzenle">
                                <i data-lucide="file-pen-line"></i>
                                <span>Düzenle</span>
                            </a>
                            <form method="POST" action="/admin/notes/<?= $note['id'] ?>" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <button type="submit" class="button button-delete" title="Sil" onclick="return confirm('Bu notu silmek istediğinizden emin misiniz?')">
                                    <i data-lucide="trash-2"></i>
                                    <span>Sil</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<script>
    lucide.createIcons();
</script>

<?php require BASE_PATH . '/templates/partials/admin_footer.php'; ?>
