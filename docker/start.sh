#!/bin/sh

set -e

php artisan storage:link || true
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

php-fpm -D

nginx -g "daemon off;"
