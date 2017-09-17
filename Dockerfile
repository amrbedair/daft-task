
FROM php:7.1.9-apache

RUN a2enmod rewrite

COPY ./ /var/www/html

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils

RUN apt-get update && apt-get install -y zlib1g-dev && \
	docker-php-ext-install zip

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php

WORKDIR yii2
RUN /var/www/html/composer.phar install

WORKDIR ../laravel-vuejs/backend
RUN /var/www/html/composer.phar install

EXPOSE 80