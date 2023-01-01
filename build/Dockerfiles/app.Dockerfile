FROM php:8.1.13-fpm-bullseye
RUN docker-php-ext-install pdo_mysql
WORKDIR /var/www/html/
COPY --from=build --chown=www-data:www-data /var/www/html/ .
