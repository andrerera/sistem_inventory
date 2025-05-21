# Gunakan image PHP resmi dengan ekstensi yang diperlukan
FROM php:8.1-apache

# Instal dependensi sistem yang diperlukan
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Aktifkan modul Apache untuk rewrite
RUN a2enmod rewrite

# Salin file proyek ke dalam container
COPY . /var/www/html

# Set direktori kerja
WORKDIR /var/www/html

# Pastikan kepemilikan file sesuai
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Konfigurasi Apache untuk menggunakan public sebagai root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 80
EXPOSE 80

# Mulai server Apache
CMD ["apache2-foreground"]