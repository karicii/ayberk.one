<?php

authorize();

$pageTitle = "Yeni Kategori Ekle";

view('admin/categories/create.php', [
    'pageTitle' => $pageTitle
]);
