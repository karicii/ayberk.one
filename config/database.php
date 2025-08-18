<?php
declare(strict_types=1);

namespace App\Config;

use PDO;
use PDOException;

class Database {
    private string $host = 'db';
    private string $db_name = 'ayberk_one_db';
    private string $username = 'ayberk';
    private string $password = '1234';

    public function connect(): ?PDO {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE =>
                PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, 
            ];

            return new PDO($dsn, $this->username , $this->password, $options);
        } catch (PDOException $e) {
            die ('DB ERR: ' . $e->getMessage());
        }
    }
}
?>