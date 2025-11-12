# Composer Installer (used only to fetch the binary)
FROM composer:2 AS composer_install

# Start from the official FrankenPHP image
FROM dunglas/frankenphp:latest

# Install necessary system dependencies: git, unzip, and supervisor
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    git \
    unzip \
    supervisor \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install required PHP extensions, including pdo_pgsql for PostgreSQL and pcntl for Octane
# and supervisor/worker process control.
RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    pcntl \
    opcache

# Copy Composer from the installer stage
COPY --from=composer_install /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application code (excluding files in .dockerignore if you create one)
COPY . /app

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy the Supervisor configuration file
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Use a volume for Octane's cache/state if needed
VOLUME /app/bootstrap/cache/octane

# Run Supervisor, which in turn starts FrankenPHP (via Octane) and the Laravel Worker.
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]