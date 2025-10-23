<?php

authorize();

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/admin/tags');
}

$db = App::resolve('database');
global $router;
$id = $router->params('id');

$tag = $db->query('SELECT * FROM tags WHERE id = :id', [':id' => $id])->find();

if (!$tag) {
    $_SESSION['error'] = 'Etiket bulunamadı.';
    redirect('/admin/tags');
}

// Etiket sil (CASCADE ile post_tags ilişkileri otomatik silinir)
$db->query('DELETE FROM tags WHERE id = :id', [':id' => $id]);

$_SESSION['success'] = 'Etiket başarıyla silindi!';
redirect('/admin/tags');
