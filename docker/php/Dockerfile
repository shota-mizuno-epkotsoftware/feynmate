FROM php:8.4-fpm

# Laravelに必要なシステムパッケージ
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql zip mbstring gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composerを公式イメージから拝借
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html