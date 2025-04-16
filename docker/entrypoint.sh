#!/bin/bash
set -e

echo "🚀 Starting app - waiting for DB at $DB_HOST:$DB_PORT..."

# Tunggu sampai DB bisa diakses
until nc -z "$DB_HOST" "$DB_PORT"; do
  echo "⏳ Waiting for database connection..."
  sleep 2
done

echo "✅ Database is up - running migrations & seed"

# Laravel commands
php artisan migrate --force
php artisan db:seed --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
