<?php
// karicii/ayberk.one/ayberk.one-8fd94fe98db51444eee7093e4a365470177f6116/controllers/admin/messages/destroy.php

authorize();

$db = App::resolve('database');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        abort(403);
    }
    
    $id = $_POST['id'];
    
    // --- DÜZELTME BURADA ---
    // 1. Önce mesajı bul
    $message = $db->query('SELECT * FROM messages WHERE id = :id', ['id' => $id])->find();

    // 2. Mesaj yoksa 404 hatası ver
    if (!$message) {
        http_response_code(404);
        require BASE_PATH . "/templates/404.php";
        die();
    }
    // --- DÜZELTME SONU ---

    // Mesaj varsa sil
    $db->query('DELETE FROM messages WHERE id = :id', ['id' => $id]);
    
    $_SESSION['success_message'] = 'Mesaj başarıyla silindi.';
    header('location: /admin/messages');
    exit();
} else {
    // POST dışındaki isteklere izin verme
    http_response_code(405);
    require BASE_PATH . "/templates/405.php";
    die();
}