# Use a modern, official PHP image with Apache
FROM php:8.2-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies and PHP extensions needed for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache's mod_rewrite for Laravel's pretty URLs
RUN a2enmod rewrite

# Copy the Apache virtual host configuration
COPY ./docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy your application code into the container
COPY . .

# Install your project's Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix file permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for Apache
EXPOSE 80