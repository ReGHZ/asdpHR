#!/bin/bash

echo "🚀 Starting app - waiting for DB at ${DB_HOST}:${DB_PORT}..."

# Tunggu sampai DB ready
until nc -z "$DB_HOST" "$DB_PORT"; do
  echo "⏳ Waiting for database..."
  sleep 2
done

echo "✅ Database is up - running migrations & seed"

sleep 5 # Delay tambahan biar DB bener-bener siap

php artisan config:clear
php artisan config:cache

php artisan migrate --force || exit 1
php artisan db:seed --force || exit 1

# Start Laravel
php artisan serve --host=0.0.0.0 --port=8000
