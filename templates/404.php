<?php 
http_response_code(404);
// Bu sayfada header'ı kullanmayacağız ki tam ekran olsun.
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Sayfa Bulunamadı</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="error-page-body">

<div class="error-page-container">
    <div class="error-content">
        <div class="pixel-grid">
            <div class="digit">
                <span class="p"></span><span class="p a"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p a"></span><span class="p a"></span><span class="p a"></span><span class="p a"></span>
                <span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
            </div>
            <div class="digit">
                <span class="p"></span><span class="p a"></span><span class="p a"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p a"></span>
                <span class="p a"></span><span class="p"></span><span class="p a"></span><span class="p"></span><span class="p a"></span>
                <span class="p a"></span><span class="p a"></span><span class="p"></span><span class="p"></span><span class="p a"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span>
                <span class="p"></span><span class="p a"></span><span class="p a"></span><span class="p a"></span><span class="p"></span>
            </div>
            <div class="digit">
                <span class="p"></span><span class="p a"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p a"></span><span class="p a"></span><span class="p a"></span><span class="p a"></span><span class="p a"></span>
                <span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
                <span class="p"></span><span class="p"></span><span class="p"></span><span class="p a"></span><span class="p"></span>
            </div>
        </div>
        <p class="error-headline">Oops! Rota kaybolmuş gibi görünüyor.</p>
        <p class="error-subtext">Seni tekrar doğru yola çıkaralım.</p>
        <a href="/" class="button error-button">Ana Sayfaya Dön</a>
    </div>
</div>

</body>
</html>