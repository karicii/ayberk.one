<?php
authorize();

$pageTitle = 'Yeni Yazı Oluştur';

view('posts/create.php', [
    'pageTitle' => $pageTitle
]);