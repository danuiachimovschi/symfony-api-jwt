FROM php:8.2-fpm

#install driver for postgres

RUN apt-get update \
    && apt-get install -y git libpq-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo_pgsql zip \
    && docker-php-ext-enable pdo_pgsql zip

# Install required packages, including libzmq
RUN apt-get update && \
    apt-get install -y \
        git \
        libzmq3-dev && \
    rm -rf /var/lib/apt/lists/*

# Clone the php-zmq repository
RUN git clone https://github.com/zeromq/php-zmq.git /usr/src/php-zmq

# Set the working directory
WORKDIR /usr/src/php-zmq

# Build and install the ZeroMQ extension
RUN phpize && \
    ./configure && \
    make && \
    make install && \
    docker-php-ext-enable zmq


# install pcntl and enable it
RUN docker-php-ext-install pcntl

COPY ./_docker/app/ws/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

# Assign permissions of the working directory to the www-data user
# RUN chown -R www-data:www-data /var/www
# RUN chmod -R 777 storage
# RUN chmod -R 777 bootstrap/cache
# RUN chmod -R 777 storage/logs

WORKDIR /var/ratchet_ws
ADD . /var/ratchet_ws

RUN chown -R www-data:www-data /var/ratchet_ws


