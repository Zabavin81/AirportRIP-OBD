FROM php:8.2.27-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl\
    zip\
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www