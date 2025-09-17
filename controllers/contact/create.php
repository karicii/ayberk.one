<?php 

// Session'dan başarı mesajını al
$success_message = $_SESSION['success_message'] ?? null;

// Mesajı değişkene aktardıktan sonra tekrar gösterilmemesi için session'dan sil
if (isset($_SESSION['success_message'])) {
    unset($_SESSION['success_message']);
}

view('contact/create.php', [
    'title' => 'İletişim',
    'description' => 'Benimle iletişime geçin.',
    // Değişkeni view'e gönder
    'success_message' => $success_message,
    'old' => $_POST // Hata durumunda form verilerini korumak için
]);