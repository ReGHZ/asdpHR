FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip gnupg2 \
    libzip-dev libonig-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy all project files to /app
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies (optional)
RUN npm ci

# Laravel optimizations (clear & cache config, route, etc.)
RUN chmod +x ./build-app.sh && ./build-app.sh

# Copy entrypoint script from docker folder
COPY docker/entrypoint.sh /app/entrypoint.sh
RUN chmod +x /app/entrypoint.sh

# Expose port
EXPOSE 8000

# Run entrypoint script on container start
ENTRYPOINT ["sh", "/app/entrypoint.sh"]
