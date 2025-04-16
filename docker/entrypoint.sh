#!/bin/bash

# Tunggu database ready
until nc -z ${DB_HOST} ${DB_PORT}; do
  echo "Waiting for database connection..."
  sleep 2
done

# Laravel migrate dan seed
php artisan migrate --force
php artisan db:seed --force

# Start server
php artisan serve --host=0.0.0.0 --port=8000
