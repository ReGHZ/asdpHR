FROM php:8.2-fpm

# Install system dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git curl unzip zip gnupg2 \
    libzip-dev libonig-dev libxml2-dev \
    nodejs npm \
    netcat-openbsd \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
RUN npm ci

# Laravel build script
RUN chmod +x ./build-app.sh && ./build-app.sh

# Copy and set permissions for entrypoint
COPY docker/entrypoint.sh /app/entrypoint.sh
RUN chmod +x /app/entrypoint.sh

# Expose Laravel port
EXPOSE 8000

# Start entrypoint
ENTRYPOINT ["/app/entrypoint.sh"]
