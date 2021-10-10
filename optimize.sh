#!/bin/bash

php artisan cache:clear

php artisan config:cache

php artisan view:clear

composer dump-autoload
