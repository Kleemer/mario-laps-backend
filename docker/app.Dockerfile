FROM php:alpine

COPY artisan /var/www/
COPY composer.lock composer.json /var/www/

COPY database /var/www/database

WORKDIR /var/www

RUN docker-php-ext-install pdo_mysql && \
    apk add --no-cache bash

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

RUN chown -R www-data:www-data \
        /var/www/storage \
        /var/www/bootstrap/cache

RUN mv .env.production .env
