<?php
session_start();
include 'includes/config.php';
include 'comps/header.php';
?>

<main class="container">
    <h1>Anasayfa</h1>
    <p></p>
    
    <div style="height: 2000px; background-color: var(--color-subtle); border-radius: var(--border-radius); padding: var(--spacing-lg);">
        Burası uzun bir içerik alanı...
    </div>

    <form action="/includes/route.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <button type="submit">CSRF Test</button>
    </form>
</main>

<?php 
include 'inc/footer.php'; 
?>
