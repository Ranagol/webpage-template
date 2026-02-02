# docker, start from here. We will need this php: image, with that version. Pulls in Linux, ads PHP.
# To always use the latest stable PHP version in your Dockerfile, you can use the php:apache tag. 
# This tag will pull the latest stable version of PHP with Apache.
FROM php:8.3-apache

# Copy docker/vhost.conf file from our host pc to etc/apache2/... location in the php container.
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set ServerName globally to suppress Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

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
    && docker-php-ext-install soap calendar zip gd mbstring dom xml xmlwriter \
    && yes | pecl install xdebug



# Get latest Composer, composer is copied from the Docker hub. The left /usr/bin/composer is the path
# in the Composer image, the source. The right /usr/bin/composer is the path in the PHP image, the destination.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Creating a file, where Xdebug will log its problems
RUN touch /var/log/xdebug.log && \chmod 666 /var/log/xdebug.log

# here we copy our custom xdebug setup from our pc host into docker container
COPY docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

