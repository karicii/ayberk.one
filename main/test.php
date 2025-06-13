<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stil Rehberi Test Sayfası (Güncel)</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/root.css">

    <style>
        /* Sadece bu test sayfasına özel yardımcı stiller */
        .color-box {
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-sm);
            border-radius: var(--border-radius);
            font-family: monospace;
            border: 1px solid var(--color-border);
        }
        .spacing-box {
            background-color: var(--color-primary);
            height: var(--spacing-md);
        }
        .section-divider {
            border: 0;
            height: 1px;
            background-color: var(--color-border);
            margin: var(--spacing-xxl) 0;
        }
        /* Kart bileşeni için daha temiz bir yapı */
        .card {
            background-color: var(--color-subtle);
            border: 1px solid var(--color-border);
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
        }
    </style>
</head>
<body>

    <main class="container">

        <h1>Stil Rehberi & Komponent Testi (v2)</h1>
        <p>Bu sayfa, `.btn` sınıfı ve güncellenmiş renk paleti dahil en son stil kurallarını test etmek için oluşturulmuştur.</p>

        <hr class="section-divider">

        <section>
            <h2>1. Renk Paleti (Uyumlu Hali)</h2>
            <div class="color-box" style="background-color: #000000; color: #EAEAEA;">--color-background: #000000</div>
            <div class="color-box" style="background-color: #EAEAEA; color: #000000;">--color-foreground: #EAEAEA</div>
            <div class="color-box" style="background-color: #2141e2; color: white;">--color-primary: #2141e2</div>
            <div class="color-box" style="background-color: #999999; color: white;">--color-secondary (Önerilen): #999999</div>
            <div class="color-box" style="background-color: #1A1A1A; color: #EAEAEA;">--color-subtle (Önerilen): #1A1A1A</div>
            <div class="color-box" style="background-color: #2A2A2A; color: #EAEAEA;">--color-border (Önerilen): #2A2A2A</div>
        </section>
        
        <hr class="section-divider">

        <section>
            <h2>2. UI Elementleri</h2>
            <p>Buton artık `.btn` sınıfını kullanıyor. Üzerine gelerek yeni "glow" efektini test et.</p>
            
            <button class="btn">Modern Buton</button>

            <div class="card" style="margin-top: var(--spacing-lg);">
                <h3>Bu bir Kart (`.card`)</h3>
                <p>Arka planı `--color-subtle`, kenarlığı `--color-border` değişkenlerini kullanıyor. Artık daha temiz!</p>
            </div>
        </section>

        <hr class="section-divider">

        <section>
            <h2>3. Tipografi</h2>
            <h1>Başlık 1 (H1)</h1>
            <h2>Başlık 2 (H2)</h2>
            <p>
                Bu bir paragraf metnidir. <strong>Kalın (strong)</strong> ve <em>italik (em)</em> metinleri içerir. Projemizin ana rengi olan <a href="#">bu linke</a> (`--color-primary`) tıklayarak hover efektini görebilirsiniz.
            </p>
        </section>

    </main>

</body>
</html>