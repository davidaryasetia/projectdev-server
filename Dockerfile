FROM php:8.0-fpm

# install extension 
RUN docker-php-ext-install mysqli pdo pdo_mysql 

WORKDIR /var/www/html 

COPY /src /var/www/html/ 

RUN chown -R www-data:www-data /var/www/html