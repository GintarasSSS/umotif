#!/bin/bash

FILE=.env
SQLITE=database/database.sqlite

if [[ -f "$SQLITE" ]]; then
    rm "$SQLITE"
fi

touch "$SQLITE"

if [[ -f "$FILE" ]]; then
    rm "$FILE"
fi

if [[ -f "$FILE" ]]; then
    rm "$FILE"
fi

cp .env.example "$FILE"

php artisan migrate:fresh
php artisan db:seed
php artisan serve
