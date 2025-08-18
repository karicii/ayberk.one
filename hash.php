<?php
// Buraya admin kullanıcısı için belirlediğin ve Postman'de kullanacağın şifreyi yaz
$passwordToHash = 'Neogeo3029281881';

// PHP'nin standart ve en güvenli hash fonksiyonu
$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

// Sonucu ekrana yazdır
echo $hashedPassword;