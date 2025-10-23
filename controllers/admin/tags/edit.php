<?php

authorize();

$db = App::resolve('database');
global $router;
$id = $router->params('id');

$tag = $db->query('SELECT * FROM tags WHERE id = :id', [':id' => $id])->find();

if (!$tag) {
    $_SESSION['error'] = 'Etiket bulunamadı.';
    redirect('/admin/tags');
}

return view('admin/tags/edit.php', [
    'tag' => $tag,
    'title' => 'Etiket Düzenle'
]);
