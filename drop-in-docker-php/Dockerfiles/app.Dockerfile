FROM php:8.1.13-fpm-bullseye
ARG UID
RUN usermod -u $UID www-data && groupmod -g $UID www-data
RUN apt-get update && apt-get install -y sudo
RUN echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN docker-php-ext-install pdo_mysql
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs && npm i -g npm