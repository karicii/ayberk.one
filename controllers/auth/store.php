<?php

$email = $_POST['email'];
$password = $_POST['password'];

// !! GEÇİCİ KONTROL !!
// Burası, veritabanı bağlantısı yapıldığında güncellenecek.
// Şimdilik sadece önceden belirlediğimiz bir e-posta ve şifre ile giriş yapılmasına izin veriyoruz.
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

// Giriş başarısız, formu hata ile tekrar göster.
view('auth/login.php', [
    'error' => 'Geçersiz e-posta veya şifre.'
]);