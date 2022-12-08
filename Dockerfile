FROM php:7.3-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
COPY ./src/api /var/www/html