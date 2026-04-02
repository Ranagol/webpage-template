FROM php:8.3-fpm

WORKDIR /srv/www

#RUN that is used to execute commands on top of the images, and here we install xdebug too
RUN apt-get update && apt-get install -y \
    curl nano git zip unzip libpng-dev libonig-dev libzip-dev \
    libxml2-dev libmagickwand-dev \
    && docker-php-ext-install \
        pdo pdo_mysql soap calendar zip gd mbstring dom xml xmlwriter \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Get latest Composer, composer is copied from the Docker hub. The left /usr/bin/composer is the path
# in the Composer image, the source. The right /usr/bin/composer is the path in the PHP image, the destination.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Creating a file, where Xdebug will log its problems
RUN touch /var/log/xdebug.log && chmod 666 /var/log/xdebug.log

# here we copy our custom xdebug setup from our pc host into docker container
COPY docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

