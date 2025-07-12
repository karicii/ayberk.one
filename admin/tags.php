<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/includes/header.php';

// Etiket ekleme, düzenleme, silme işlemleri burada olacak

?>

<main class="container">
    <h1>Tags</h1>
    
    <a href="tag_edit.php">Add New Tag</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Etiketler veritabanından çekilecek
            ?>
        </tbody>
    </table>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>