<?php
declare(strict_types=1);

namespace App\Api;

use PDO;
use PDOException;

class userRepo 
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findByEmail(string $email): array|false 
    {
        $query = "
            SELECT
                id,
                name,
                email,
                password,
                role
            FROM
                users
            WHERE
                email = :email
            LIMIT 1
        ";

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch();
        } catch(PDOException $e) {
            error_log('userRepo ERR: ' . $e->getMessage());
            return false;
        }
    }
} 