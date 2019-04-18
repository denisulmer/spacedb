#!/bin/bash
npm install
composer install
npm run dev
php artisan migrate:refresh
php artisan cache:clear
php artisan clear-compiled
composer dump-autoload
php artisan db:seed