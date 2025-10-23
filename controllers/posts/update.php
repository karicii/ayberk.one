<?php
verify_csrf_token();
authorize();

$db = App::resolve('database');

require_once BASE_PATH . '/core/ReadingTime.php';
global $router;
$id = $router->params('id');
$currentUserId = $_SESSION['user']['id'];

// Güncellenecek yazıyı bul
$post = $db->query('SELECT * FROM posts WHERE id = :id AND user_id = :user_id', [
    ':id' => $id,
    ':user_id' => $currentUserId
])->find();

if (!$post) {
    http_response_code(403);
    die('Yetkisiz erişim.');
}

$title = $_POST['title'] ?? null;
$body = $_POST['body'] ?? null;
$errors = [];

if (empty($title)) {
    $errors[] = 'Başlık zorunludur.';
}

$imagePath = $post['image_path'];
if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = BASE_PATH . '/public/uploads/';
    $fileName = uniqid() . '-' . basename($_FILES['post_image']['name']);
    $targetFile = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['post_image']['tmp_name'], $targetFile)) {
        if ($imagePath && file_exists(BASE_PATH . '/public' . $imagePath)) {
            unlink(BASE_PATH . '/public' . $imagePath);
        }
        $imagePath = '/uploads/' . $fileName;
    } else {
        $errors[] = 'Yeni görsel yüklenirken bir hata oluştu.';
    }
}

if (empty($errors)) {
    // Slug'ı sadece başlık değiştiyse yeniden oluştur
    $slug = ($post['title'] !== $title) ? slugify($title) : $post['slug'];
    $readingTime = ReadingTime::calculate($body);

    // 1. Yazı bilgilerini GÜNCELLE (Doğru SQL komutu)
    $db->query(
        'UPDATE posts SET title = :title, slug = :slug, body = :body, image_path = :image_path, reading_time = :reading_time WHERE id = :id',
        [
            ':id' => $id,
            ':title' => $title,
            ':slug' => $slug,
            ':body' => $body,
            ':image_path' => $imagePath,
            ':reading_time' => $readingTime
        ]
    );

    // 2. Bu yazıya ait tüm eski kategori ilişkilerini sil
    $db->query('DELETE FROM post_categories WHERE post_id = :post_id', [':post_id' => $id]);

    // 3. Yeni seçilen kategorileri ekle
    if (!empty($_POST['categories'])) {
        foreach ($_POST['categories'] as $categoryId) {
            $db->query(
                'INSERT INTO post_categories(post_id, category_id) VALUES(:post_id, :category_id)',
                [
                    ':post_id' => $id,
                    ':category_id' => $categoryId
                ]
            );
        }
    }

    // 4. Bu yazıya ait tüm eski etiket ilişkilerini sil
    $db->query('DELETE FROM post_tags WHERE post_id = :post_id', [':post_id' => $id]);

    // 5. Yeni etiketleri işle (inline input'tan)
    if (!empty($_POST['tags_input'])) {
        // Virgülle ayrılmış etiketleri temizle ve diziye çevir
        $tagNames = array_map('trim', explode(',', $_POST['tags_input']));
        $tagNames = array_filter($tagNames); // Boşları temizle
        
        foreach ($tagNames as $tagName) {
            // Slug oluştur
            $tagSlug = slugify($tagName);
            
            // Etiket var mı kontrol et
            $existingTag = $db->query('SELECT id FROM tags WHERE slug = :slug', [':slug' => $tagSlug])->find();
            
            if ($existingTag) {
                // Var olan etiketi kullan
                $tagId = $existingTag['id'];
            } else {
                // Yeni etiket oluştur
                $db->query('INSERT INTO tags (name, slug) VALUES (:name, :slug)', [
                    ':name' => $tagName,
                    ':slug' => $tagSlug
                ]);
                $tagId = $db->connection->lastInsertId();
            }
            
            // Post-tag ilişkisi ekle (duplicate check)
            $existing = $db->query('SELECT COUNT(*) as count FROM post_tags WHERE post_id = :post_id AND tag_id = :tag_id', [
                ':post_id' => $id,
                ':tag_id' => $tagId
            ])->find();
            
            if ($existing['count'] == 0) {
                $db->query('INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)', [
                    ':post_id' => $id,
                    ':tag_id' => $tagId
                ]);
            }
        }
    }
    
    header('Location: /admin');
    exit();
}

// Hata varsa formu tekrar göster
$categories = $db->query('SELECT * FROM categories ORDER BY name ASC')->findAll();
$tags = $db->query('SELECT * FROM tags ORDER BY name ASC')->findAll();
$postCategoryIds = $db->query('SELECT category_id FROM post_categories WHERE post_id = :post_id', [':post_id' => $id])->findAll(PDO::FETCH_COLUMN);
$postTagIds = $db->query('SELECT tag_id FROM post_tags WHERE post_id = :post_id', [':post_id' => $id])->findAll(PDO::FETCH_COLUMN);
$pageTitle = 'Yazıyı Düzenle';
view('posts/edit.php', [
    'pageTitle' => $pageTitle,
    'post' => $post,
    'categories' => $categories,
    'postCategoryIds' => $postCategoryIds,
    'tags' => $tags,
    'postTagIds' => $postTagIds,
    'errors' => $errors
]);