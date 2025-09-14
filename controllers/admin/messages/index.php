<?php
authorize();

$db = App::resolve('database');

$messages = $db->query('SELECT * FROM messages ORDER BY created_at DESC')->findAll();

view('admin/messages/index.php', [
    'title' => 'Gelen Mesajlar',
    'messages' => $messages
]);