<?php

$email = $_POST['email'];
$password = $_POST['password'];

$adminEmail = 'mail@ayberk.one';
$adminPassword = 'COKGUVENCELIBIRSIFRE';

if ($email === $adminEmail && $password === $adminPassword) {
    $_SESSION['user'] = [
        'id' => 1, // Sabit ID
        'email' => $adminEmail,
        'username' => 'ayberk'
    ];

    header('Location: /');
    exit();
}

view('auth/login.php', [
    'error' => 'Geçersiz e-posta veya şifre.'
]);