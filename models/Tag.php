<?php

class Tag
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $statement = $this->db->prepare("
            SELECT t.*, 
                   COUNT(pt.post_id) as post_count
            FROM tags t
            LEFT JOIN post_tags pt ON t.id = pt.tag_id
            GROUP BY t.id
            ORDER BY t.name ASC
        ");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function find($id)
    {
        $statement = $this->db->prepare("SELECT * FROM tags WHERE id = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }

    public function findBySlug($slug)
    {
        $statement = $this->db->prepare("SELECT * FROM tags WHERE slug = :slug");
        $statement->execute(['slug' => $slug]);
        return $statement->fetch();
    }

    public function create($data)
    {
        $statement = $this->db->prepare("
            INSERT INTO tags (name, slug, description) 
            VALUES (:name, :slug, :description)
        ");
        
        return $statement->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $statement = $this->db->prepare("
            UPDATE tags 
            SET name = :name, 
                slug = :slug, 
                description = :description
            WHERE id = :id
        ");
        
        return $statement->execute([
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null
        ]);
    }

    public function delete($id)
    {
        $statement = $this->db->prepare("DELETE FROM tags WHERE id = :id");
        return $statement->execute(['id' => $id]);
    }

    public function getPostsByTag($tagId)
    {
        $statement = $this->db->prepare("
            SELECT p.* 
            FROM posts p
            INNER JOIN post_tags pt ON p.id = pt.post_id
            WHERE pt.tag_id = :tag_id
            ORDER BY p.created_at DESC
        ");
        $statement->execute(['tag_id' => $tagId]);
        return $statement->fetchAll();
    }

    public function getTagsByPost($postId)
    {
        $statement = $this->db->prepare("
            SELECT t.* 
            FROM tags t
            INNER JOIN post_tags pt ON t.id = pt.tag_id
            WHERE pt.post_id = :post_id
            ORDER BY t.name ASC
        ");
        $statement->execute(['post_id' => $postId]);
        return $statement->fetchAll();
    }

    public function attachToPost($postId, $tagIds)
    {
        // Önce mevcut etiketleri temizle
        $this->detachFromPost($postId);

        // Yeni etiketleri ekle
        if (!empty($tagIds)) {
            $statement = $this->db->prepare("
                INSERT INTO post_tags (post_id, tag_id) 
                VALUES (:post_id, :tag_id)
            ");

            foreach ($tagIds as $tagId) {
                $statement->execute([
                    'post_id' => $postId,
                    'tag_id' => $tagId
                ]);
            }
        }

        return true;
    }

    public function detachFromPost($postId)
    {
        $statement = $this->db->prepare("DELETE FROM post_tags WHERE post_id = :post_id");
        return $statement->execute(['post_id' => $postId]);
    }

    public function exists($name, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM tags WHERE name = :name";
        $params = ['name' => $name];

        if ($excludeId) {
            $sql .= " AND id != :id";
            $params['id'] = $excludeId;
        }

        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement->fetchColumn() > 0;
    }

    public function slugExists($slug, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM tags WHERE slug = :slug";
        $params = ['slug' => $slug];

        if ($excludeId) {
            $sql .= " AND id != :id";
            $params['id'] = $excludeId;
        }

        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement->fetchColumn() > 0;
    }
}
