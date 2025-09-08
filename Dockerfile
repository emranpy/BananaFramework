# Use PHP 8.2 CLI (compatible with your dev dependencies)
FROM php:8.2-cli

# Install required extensions
RUN apt-get update && apt-get install -y unzip git zip \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Install project dependencies
RUN composer install
