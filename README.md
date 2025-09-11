# Ayberk.One - Lightweight PHP CMS

> Modern, hızlı ve minimalist PHP tabanlı içerik yönetim sistemi

## Özellikler | Features

### Türkçe
- **Hafif ve Hızlı**: Minimum kaynak tüketimi ile maksimum performans
- **Modern Tasarım**: Responsive ve kullanıcı dostu arayüz
- **Blog Yönetimi**: Kolay makale oluşturma ve düzenleme
- **Güvenli Admin Panel**: Kullanıcı kimlik doğrulama sistemi
- **Docker Desteği**: Kolay kurulum ve dağıtım
- **SEO Dostu**: Otomatik sitemap oluşturma
- **MVC Mimarisi**: Temiz ve sürdürülebilir kod yapısı

### English
- **Lightweight & Fast**: Maximum performance with minimal resource usage
- **Modern Design**: Responsive and user-friendly interface
- **Blog Management**: Easy article creation and editing
- **Secure Admin Panel**: User authentication system
- **Docker Support**: Easy installation and deployment
- **SEO Friendly**: Automatic sitemap generation
- **MVC Architecture**: Clean and maintainable code structure

## Hızlı Başlangıç | Quick Start

### Docker ile Kurulum | Docker Installation

```bash
# Projeyi klonlayın | Clone the project
git clone https://github.com/karicii/ayberk.one.git
cd ayberk.one

# Docker ile başlatın | Start with Docker
docker-compose up -d

# Tarayıcınızda açın | Open in browser
http://localhost:8080
```

### Manuel Kurulum | Manual Installation

```bash
# Projeyi klonlayın | Clone the project
git clone https://github.com/karicii/ayberk.one.git
cd ayberk.one

# Çevre değişkenlerini ayarlayın | Setup environment variables
cp .env.example .env

# Veritabanını yapılandırın | Configure database
# .env dosyasını düzenleyin | Edit .env file

# Web sunucunuzu başlatın | Start your web server
# Apache/Nginx'i public/ klasörüne yönlendirin
# Point Apache/Nginx to public/ directory
```

## Proje Yapısı | Project Structure

```
ayberk.one/
├── core/                    # Çekirdek sistem dosyaları | Core system files
│   ├── App.php              # Uygulama sınıfı | Application class
│   ├── Router.php           # Yönlendirici | Router
│   ├── Database.php         # Veritabanı bağlantısı | Database connection
│   └── config.php           # Yapılandırma | Configuration
├── controllers/             # Kontrolcüler | Controllers
│   ├── auth/                # Kimlik doğrulama | Authentication
│   └── posts/               # Makale yönetimi | Post management
├── templates/               # Görünüm dosyaları | View files
│   ├── partials/            # Parçalı görünümler | Partial views
│   └── posts/               # Makale şablonları | Post templates
├── public/                  # Genel erişilebilir dosyalar | Public files
│   ├── assets/              # CSS, JS, resimler | CSS, JS, images
│   └── index.php            # Giriş noktası | Entry point
├── docker/                  # Docker yapılandırması | Docker configuration
└── routes.php               # Yönlendirme tanımları | Route definitions
```

## Yapılandırma | Configuration

### Çevre Değişkenleri | Environment Variables

```bash
# .env dosyasını düzenleyin | Edit .env file
APP_URL=http://localhost:8080
DB_HOST=localhost
DB_PORT=3306
DB_NAME=ayberk_cms
DB_USER=root
DB_PASS=password
```

## API Rotaları | API Routes

### Genel Rotalar | Public Routes
- `GET /` - Ana sayfa | Homepage
- `GET /posts/{slug}` - Makale detayı | Post detail
- `GET /sitemap.xml` - Site haritası | Sitemap

### Admin Rotaları | Admin Routes
- `GET /login` - Giriş sayfası | Login page
- `POST /login` - Giriş işlemi | Login process
- `POST /logout` - Çıkış işlemi | Logout process
- `GET /admin/posts/create` - Yeni makale | New post
- `POST /admin/posts` - Makale kaydet | Save post
- `GET /admin/posts/edit/{id}` - Makale düzenle | Edit post
- `PATCH /admin/posts/{id}` - Makale güncelle | Update post
- `DELETE /admin/posts/{id}` - Makale sil | Delete post

## Geliştirme | Development

### Gereksinimler | Requirements
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- Apache/Nginx
- Composer (opsiyonel | optional)

### Geliştirici Notları | Developer Notes
```bash
# Veritabanı migrasyonları | Database migrations
# docker/database/init.sql dosyasını kullanın
# Use docker/database/init.sql file

# Log dosyaları | Log files
tail -f storage/logs/app.log

# Cache temizleme | Clear cache
rm -rf storage/cache/*
```

## Katkıda Bulunma | Contributing

1. Projeyi fork edin | Fork the project
2. Feature branch oluşturun | Create a feature branch
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. Değişikliklerinizi commit edin | Commit your changes
   ```bash
   git commit -m 'feat: Add amazing feature'
   ```
4. Branch'inizi push edin | Push your branch
   ```bash
   git push origin feature/amazing-feature
   ```
5. Pull Request oluşturun | Create a Pull Request

## Lisans | License

Bu proje Apache 2.0 lisansı altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına bakın.

This project is licensed under the Apache 2.0 License. See the [LICENSE](LICENSE) file for details.

## Geliştirici | Developer

**Ayberk Arıcı** - [@karicii](https://github.com/karicii)

## Destek | Support

Eğer bu proje işinize yaradıysa, yıldız vererek destek olabilirsiniz!

If this project helped you, please consider giving it a star!

---

<div align="center">
  <strong>Modern ve minimalist PHP CMS</strong>
  <br>
  <strong>Modern and minimalist PHP CMS</strong>
</div>
