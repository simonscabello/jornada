#!/bin/bash

set -e

npm ci

npm run build

php artisan optimize:clear

php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache