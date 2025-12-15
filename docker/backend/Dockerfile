FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# Copy application files and set ownership to www (performed as root)
COPY --chown=www:www . /var/www

# Ensure correct permissions on /var/www (still running as root)
RUN chown -R www:www /var/www && chmod -R 755 /var/www

# Change current user to www
USER www

# Install dependencies (composer will create /var/www/vendor as the www user owns the dir)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]