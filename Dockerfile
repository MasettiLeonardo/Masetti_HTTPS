FROM php:8.1-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli # per installare mysql

COPY . /var/www/html/
