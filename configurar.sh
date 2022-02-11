#!/bin/bash
echo '--------------- Configurando o Sistema ---------------'
composer install
chown -R www-data:www-data writable/
cp env .env
php spark migrate
echo '--------------- Finalizado ---------------'