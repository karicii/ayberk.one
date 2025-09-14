<?php

declare(strict_types=1);

return [
    'app' => [
        'url' => $_ENV['APP_URL'] ?? 'http://localhost'
    ],
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'port' => $_ENV['DB_PORT'] ?? 3306,
        'dbname' => $_ENV['DB_NAME'] ?? 'testdb',
        'charset' => 'utf8mb4'
    ]
];