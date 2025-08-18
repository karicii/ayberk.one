<?php 
declare(strict_types=1);

namespace App\Api;

use PDO;
use PDOException;

class postRepo 
{
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function findAllPublished(): array 
    {
        $query = "
            SELECT
                title,
                slug, 
                published_at 
            FROM
                posts 
            WHERE 
                status = 'published'
            ORDER BY 
                published_at DESC
        ";

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log('postRepo ERR: ' . $e->getMessage());
            return [];
        }
    }

    public function findBySlug(string $slug): array|false 
    {
        $query = "
            SELECT 
                title,
                slug,
                content,
                published_at
            FROM
                posts
            WHERE
                status = 'published' AND slug = :slug
            LIMIT 1
        ";
        
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':slug', $slug);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log('postRepo ERR ' . $e->getMessage());
            return false;
        }
    }

    // YENİ METOT ARTIK SINIFIN İÇİNDE
    public function create(array $data): string|false 
    {
        $query = "
            INSERT INTO posts
                (uuid, title, slug, content, status, published_at)
            VALUES
                (UUID(), :title, :slug, :content, :status, :published_at)
        ";
        
        try {
            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':slug', $data['slug']);
            $stmt->bindParam(':content', $data['content']);

            $status = $data['status'] ?? 'published';
            $published_at = date('Y-m-d H:i:s');

            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':published_at', $published_at);

            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            error_log('postRepo Create ERR: ' . $e->getMessage());
            return false;
        }
    }
}
?>