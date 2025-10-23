-- Newsletter aboneleri tablosu
CREATE TABLE IF NOT EXISTS subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NULL,
    status ENUM('active', 'unsubscribed') DEFAULT 'active',
    verification_token VARCHAR(64) NULL,
    verified_at TIMESTAMP NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    ip_address VARCHAR(45) NULL,
    user_agent VARCHAR(255) NULL,
    INDEX idx_email (email),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
