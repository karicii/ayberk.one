<?php

// Silinecek yazının ID'sini formdan al
$id = $_POST['id'] ?? null;

// user_id kontrolü: Kullanıcının sadece kendi yazılarını silebildiğinden emin ol.
// Şimdilik user_id'yi 1 varsayıyoruz. Login sistemi gelince bu dinamik olacak.
$currentUserId = 1;

// Önce silinmek istenen yazının gerçekten bu kullanıcıya ait olup olmadığını kontrol et.
$post = $db->query('SELECT * FROM posts WHERE id = :id', [':id' => $id])->find();

if ($post && $post['user_id'] === $currentUserId) {
    // Yazı bu kullanıcıya aitse, silme işlemini yap.
    $db->query('DELETE FROM posts WHERE id = :id', [
        ':id' => $id
    ]);
}

// Silme işleminden sonra anasayfaya veya yazı listesine yönlendir.
header('Location: /');
exit();