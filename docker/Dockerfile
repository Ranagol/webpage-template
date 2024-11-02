#docker, start from here. We will need this php: image, with that version. Pulls in Linux, ads PHP.
FROM php:8.0.7-apache

# Copy vhost.conf file to etc/apache2/... location.
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

#The WORKDIR instruction sets the working directory for several commands 
# such as RUN, CMD, ENTRYPOINT, COPY and ADD instructions.
# this is the working directory inside docker system
# this will be the deafult working space for docker
WORKDIR /srv/www

#RUN that is used to execute commands on top of the images, and here we install xdebug too
RUN docker-php-ext-install pdo pdo_mysql \
    && chown -R www-data:www-data /srv/www \
    && a2enmod rewrite \
    && apt-get -y update \
    && apt-get -y install dialog apt-utils nano curl libxml2-dev net-tools libfontconfig1 libxrender1 libxext6 git zip unzip libpng-dev libonig-dev \
    libzip-dev libmagickwand-dev \
    && docker-php-ext-install soap calendar zip gd \
    && yes | pecl install xdebug

# Creating a file, where Xdebug will log its problems
RUN touch /var/log/xdebug.log && \chmod 666 /var/log/xdebug.log

# Get latest Composer, composer is copied from the Docker hub. Left side is the Docker hub, right side is inside docker
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# here we copy our custom xdebug setup into docker
COPY docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

