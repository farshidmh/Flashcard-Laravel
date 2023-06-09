FROM php:8.1-apache-buster

WORKDIR /var/www/html

COPY . .

RUN apt update  \
    && apt install unzip git -y  \
    && curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

RUN chmod o+w storage/ -R

