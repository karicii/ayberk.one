<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/includes/header.php';

// Kategori ekleme, düzenleme, silme işlemleri burada olacak

?>

<main class="container">
    <h1>Categories</h1>
    
    <a href="category_edit.php">Add New Category</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kategoriler veritabanından çekilecek
            ?>
        </tbody>
    </table>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>