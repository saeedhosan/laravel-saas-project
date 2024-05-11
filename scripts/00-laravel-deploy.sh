#!/usr/bin/env bash
echo "Running composer"
composer install --working-dir=/var/www/html

echo "update permissions to storage and bootstrap";

chmod -R 777 /var/www/html
chmod -R 777 /var/www/html/
chmod -R 777 /var/www/html/.
chmod -R 777 bootstrap/cache/.
chmod -R 777 storage/framework/sessions/.
chmod -R 777 storage/framework/cache/.
chmod -R 777 storage/framework/views/.
chmod -R 777 storage/logs/.

echo "generating application key..."
php artisan key:generate

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache