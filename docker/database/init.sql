CREATE DATABASE IF NOT EXISTS ayberk_one;
USE ayberk_one;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    body TEXT NOT NULL,
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=INNODB;

-- ////////////// YENİ EKLENEN BÖLÜM //////////////
-- Varsayılan admin kullanıcısını ekle
-- Şifre burada hash'lenmemiş çünkü login işlemi de hash'siz kontrol ediyor.
-- Normalde şifrelerin hash'lenerek saklanması gerekir.
INSERT INTO users (id, username, email, password) VALUES (1, 'ayberk', 'mail@ayberk.one', 'COKGUVENCELIBIRSIFRE');
-- //////////////////////////////////////////////