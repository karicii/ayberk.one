<?php

authorize();

$db = App::resolve('database');

$notes = $db->query('SELECT * FROM notes ORDER BY created_at DESC')->findAll();

$pageTitle = 'Not Yönetimi';

require BASE_PATH . '/templates/admin/notes/index.php';
