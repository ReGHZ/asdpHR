#!/bin/bash
set -e

echo "🔧 Running build-app.sh"

# Cek apakah php & artisan tersedia
which php || echo "PHP not found"
php -v || echo "PHP version not available"
ls -la || true
ls -la ./vendor || echo "Vendor folder missing"
ls -la ./artisan || echo "Artisan file missing"

# Clear cache
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
