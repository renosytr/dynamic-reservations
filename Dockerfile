FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts

FROM node:20-alpine AS nodebuild
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build

FROM dunglas/frankenphp:latest AS final

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpq-dev \
    && install-php-extensions pdo_pgsql pcntl opcache \
    && rm -rf /var/lib/apt/lists/*


WORKDIR /app

COPY . .

COPY --from=vendor /app/vendor /app/vendor

COPY --from=nodebuild /app/public/build /app/public/build

RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=80"]
