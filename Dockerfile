# --- Frontend Build Stage (Node.js) ---
# Use a specific Node.js version as the "builder"
FROM node:18-alpine AS frontend

# Set the working directory
WORKDIR /app

# Copy frontend dependency files and install them
COPY package.json package-lock.json ./
RUN npm install

# Copy the rest of the frontend source code
COPY . .

# Compile the frontend assets for production
RUN npm run build


# --- Final Application Stage (PHP) ---
# Use the same PHP image as before
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

# Copy the backend source code (excluding frontend files already handled)
COPY . .

# Install Composer dependencies
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader

# This is the magic step: Copy the compiled assets from the frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Fix file permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for Apache
EXPOSE 80