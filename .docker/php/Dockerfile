FROM php:8.2-fpm

# Install mysql extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install mysqli pdo pdo_mysql zip
RUN apt-get -y update
RUN apt-get install -y libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Install misc components
RUN apt-get install -y git unzip

# Install composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer

# Install npm
RUN apt-get install -y curl software-properties-common
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN curl -sL https://www.npmjs.com/install.sh | bash

WORKDIR /home/kylir/www/ramty
