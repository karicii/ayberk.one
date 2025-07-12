<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/includes/header.php';

// Etiket ekleme/düzenleme işlemleri burada olacak

?>

<main class="container">
    <h1>Edit Tag</h1>

    <form action="tag_edit.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <button type="submit">Save</button>
    </form>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>