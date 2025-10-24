<?php

$data = json_decode(file_get_contents('php://input'), true);
$lang = $data['lang'] ?? 'tr';

// Validate language
if (!in_array($lang, ['tr', 'en', 'fr'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid language']);
    exit;
}

// Set language
set_lang($lang);

echo json_encode(['success' => true, 'lang' => $lang]);
