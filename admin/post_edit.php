<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/includes/header.php';

// Yazı ekleme/düzenleme işlemleri burada olacak

?>

<main class="container">
    <h1>Edit Post</h1>

    <form action="post_edit.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <input type="hidden" name="content">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="editor">Content</label>
            <div id="editor"></div>
        </div>

        <button type="submit">Save</button>
    </form>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>