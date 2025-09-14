<?php

authorize();

$db = App::resolve('database');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        abort(403);
    }
    
    $id = $_POST['id'];
    
    $message = $db->query('SELECT * FROM messages WHERE id = :id', ['id' => $id])->findOrFail();

    $db->query('DELETE FROM messages WHERE id = :id', ['id' => $id]);
    
    $_SESSION['success_message'] = 'Mesaj başarıyla silindi.';
    header('location: /admin/messages');
    exit();
} else {
    abort(405);
}