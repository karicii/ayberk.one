FROM php:8.2-apache

# Gerekli PHP eklentilerini kur
RUN docker-php-ext-install pdo pdo_mysql iconv

# Sadece gerekli modülü etkinleştir
RUN a2enmod rewrite