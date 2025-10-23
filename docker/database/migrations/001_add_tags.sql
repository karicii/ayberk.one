-- Etiket sistemi için tablolar
CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

-- Yazı-Etiket ilişki tablosu
CREATE TABLE IF NOT EXISTS post_tags (
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (post_id, tag_id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
) ENGINE=INNODB;

-- Örnek etiketler
INSERT INTO tags (name, slug, description) VALUES 
('PHP', 'php', 'PHP programlama dili ile ilgili yazılar'),
('JavaScript', 'javascript', 'JavaScript ve frontend geliştirme'),
('Docker', 'docker', 'Docker ve containerization'),
('MySQL', 'mysql', 'MySQL veritabanı'),
('CSS', 'css', 'CSS ve styling'),
('Performance', 'performance', 'Performans optimizasyonu'),
('Security', 'security', 'Güvenlik ve best practices'),
('Tutorial', 'tutorial', 'Adım adım rehberler'),
('Tips', 'tips', 'İpuçları ve püf noktaları'),
('Opinion', 'opinion', 'Kişisel görüşler ve düşünceler');
