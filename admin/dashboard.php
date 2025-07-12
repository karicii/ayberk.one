<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/includes/header.php';

?>

<main class="container">
    <h1>Dashboard</h1>
    <p>Welcome to the admin panel.</p>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>