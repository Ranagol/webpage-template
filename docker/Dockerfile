FROM php:latest

WORKDIR /srv/www

RUN docker-php-ext-install pdo pdo_mysql \
    && chown -R www-data:www-data /srv/www \
    && apt-get -y update \
    && apt-get -y install dialog apt-utils nano curl libxml2-dev net-tools libfontconfig1 libxrender1 libxext6 git zip unzip libpng-dev libonig-dev \
    libzip-dev libmagickwand-dev \
    && docker-php-ext-install soap calendar zip gd \
    && yes | pecl install xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN touch /var/log/xdebug.log && chmod 666 /var/log/xdebug.log

COPY docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini