#!/usr/bin/env bash
echo "Running composer"
composer install --working-dir=/var/www/html

echo "update permissions to storage and bootstrap";
chown -R www-data:www-data /var/www/html/bootstrap /var/www/html/storage
chown -R www-data:www-data "/var/www/html/storage/logs/*.log"

echo "generating application key..."
php artisan key:generate

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache