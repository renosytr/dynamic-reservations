# Composer
FROM composer:2 AS vendor
WORKDIR /var/www/html

COPY composer.json ./

RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader

# Node
FROM node:20-alpine AS nodebuild
WORKDIR /var/www/html

COPY package*.json ./
RUN npm install

COPY resources resources
COPY vite.config.* ./
RUN npm run build

# FrankenPHP
FROM dunglas/frankenphp:latest

RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    git unzip supervisor libpq-dev curl && \
    rm -rf /var/lib/apt/lists/*

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    pcntl \
    opcache

COPY --from=vendor /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

COPY --from=vendor /var/www/html/vendor ./vendor
COPY --from=nodebuild /var/www/html/public/build ./public/build

RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

VOLUME /var/www/html/bootstrap/cache/octane

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
