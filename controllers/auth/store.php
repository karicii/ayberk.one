<?php

$db = App::resolve('database');
$email = $_POST['email'];
$password = $_POST['password'];

$user = $db->query('SELECT * FROM users WHERE email = :email', [':email' => $email])->find();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email'],
        'username' => $user['username']
    ];

    header('Location: /admin');
    exit();
}

view('auth/login.php', [
    'error' => 'Geçersiz e-posta veya şifre.'
]);