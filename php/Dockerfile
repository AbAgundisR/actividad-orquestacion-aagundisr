FROM php:8.0-apache
# Install stuff
RUN apt-get update && apt-get upgrade -y
RUN apt-get install sudo unzip wget -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql