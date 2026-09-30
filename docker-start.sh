#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

php /var/www/artisan key:generate
php /var/www/artisan migrate
#php /var/www/artisan queue:listen --timeout=0 &

php-fpm
