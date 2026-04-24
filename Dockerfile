FROM php:8.3-apache

# System dependencies for Laravel + MySQL + asset build
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        zip \
        curl \
        ca-certificates \
        gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composerrrr
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Apache rewrite for Laravel routes
RUN a2enmod rewrite

# Configure Apache document root to /public
COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf

# Install PHP dependencies first for better layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader --no-scripts

# Copy app code
COPY . .

# Run post-install scripts after full app source is present
RUN php artisan package:discover --ansi

# Build frontend assets
RUN npm install && npm run build

# Ensure writable directories for Laravel
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]