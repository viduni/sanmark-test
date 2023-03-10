FROM php:8.1.13-fpm-bullseye
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt-get update
RUN apt-get install -y git unzip
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs && npm i -g npm
WORKDIR /var/www/html/
COPY ./src/ .
RUN composer install
RUN npm install
RUN npm run build