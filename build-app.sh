#!/bin/bash
set -e

echo "🔧 Running build-app.sh"

# Cek apakah php & artisan tersedia
which php || echo "PHP not found"
php -v || echo "PHP version not available"

# Clear semua cache
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache ulang hanya jika tidak ada closure di route
php artisan config:cache
#php artisan route:cache || echo "⚠️ Route cache gagal (mungkin ada closure)"
php artisan view:cache
php artisan event:cache
