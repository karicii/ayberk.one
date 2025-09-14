<?php
verify_csrf_token();
authorize();

$pageTitle = 'Yeni Yazı Oluştur';

view('posts/create.php', [
    'pageTitle' => $pageTitle
]);