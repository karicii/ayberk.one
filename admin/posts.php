<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/includes/header.php';

// Yazı ekleme, düzenleme, silme işlemleri burada olacak

?>

<main class="container">
    <h1>Posts</h1>
    
    <a href="post_edit.php">Add New Post</a>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Yazılar veritabanından çekilecek
            ?>
        </tbody>
    </table>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>