FROM php:8.2-apache

# Gerekli PHP eklentilerini kur (Veritabanı ve slugify fonksiyonu için)
RUN docker-php-ext-install pdo pdo_mysql iconv

# Apache rewrite modülünü aktif et (.htaccess için şart)
RUN a2enmod rewrite

# Apache'nin sanal sunucu ayarlarını bizim özel ayarımızla değiştir
COPY vhost.conf /etc/apache2/sites-available/000-default.conf