<?php

// Landing page'i doğrudan serve et
$landerPath = BASE_PATH . '/lander/index.html';

if (file_exists($landerPath)) {
    readfile($landerPath);
    exit;
}

// Fallback
http_response_code(404);
echo "Landing page not found.";
