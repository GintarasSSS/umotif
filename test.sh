#!/bin/bash

php artisan config:cache --env=testing
php artisan test
php artisan config:cache --env=local
