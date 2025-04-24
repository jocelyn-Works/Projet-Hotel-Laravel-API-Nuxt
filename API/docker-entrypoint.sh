#!/bin/bash

# Start php-fpm
php-fpm &

# Start Laravel development server
php artisan serve --host=0.0.0.0 --port=8000
