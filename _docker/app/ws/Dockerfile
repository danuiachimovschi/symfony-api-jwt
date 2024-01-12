FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update && apt-get install -y inotify-tools

# install pcntl and enable it
RUN docker-php-ext-install pcntl

COPY ./_docker/app/ws/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

RUN php /usr/local/bin/composer require cboden/ratchet
# Assign permissions of the working directory to the www-data user
# RUN chown -R www-data:www-data /var/www
# RUN chmod -R 777 storage
# RUN chmod -R 777 bootstrap/cache
# RUN chmod -R 777 storage/logs

WORKDIR /var/ratchet_ws
ADD . /var/ratchet_ws
RUN chown -R www-data:www-data /var/ratchet_ws


