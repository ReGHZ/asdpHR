FROM php:8.2-fpm

# Install system dependencies + netcat
RUN apt-get update && apt-get install -y \
    git curl unzip zip gnupg2 \
    libzip-dev libonig-dev libxml2-dev \
    nodejs npm netcat-openbsd \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js deps (opsional)
RUN npm ci

# Salin entrypoint
COPY docker/entrypoint.sh /app/entrypoint.sh
RUN chmod +x /app/entrypoint.sh

# Expose port
EXPOSE 8000

# Run entrypoint
ENTRYPOINT ["/app/entrypoint.sh"]
