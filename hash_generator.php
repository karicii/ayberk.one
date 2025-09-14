<?php

// Buraya yeni şifrenizi yazın
$yeniSifre = 'Neogeo1453302928***';

$hash = password_hash($yeniSifre, PASSWORD_DEFAULT);

echo "Yeni Şifreniz: " . htmlspecialchars($yeniSifre) . "\n";
echo "Oluşturulan Hash: " . htmlspecialchars($hash) . "\n";

echo "\nBu hash'i kopyalayıp veritabanındaki users tablosunda ilgili kullanıcının password sütununa yapıştırın.\n";

?>