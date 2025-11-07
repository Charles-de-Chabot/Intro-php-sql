#* dockerfile pour PHP - FPM
FROM php:8.3-fpm-alpine
LABEL authors="prepa web"

#* mise à jour des listes des paquets dispos
RUN apk update

ENV MUSL_LOCPATH /usr/share/i18/locales/musl
#* installation des locales
RUN apk --no-cache add cmake make musl-dev gcc gettext-dev libintl \
    && wget https://gitlab.com/rilian-la-te/musl-locales/-/archive/master/musl-locales-master.zip \
    && unzip musl-locales-master.zip \
    && cd musl-locales-master \
    && cmake -DLOCALE_PROFILE=OFF -D CMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install \
    && cd .. && rm -rf musl-locales-master

RUN apk add --no-cache autoconf g++ make curl-dev pkgconfig libpng-dev libjpeg-turbo-dev \
    libwebp-dev freetype-dev libzip-dev openssl-dev libstdc++ libx11 libxrender libxext tzdata bash git linux-headers \
    libssl3 ca-certificates

#* définition des locales (langue)
ENV TZ Europe/Paris
ENV LANG fr_FR.UTF-8
ENV LANGUAGE fr_FR:fr
ENV LC_ALL fr_FR.UTF-8

#* installation des extensions pour php
RUN apk add --no-cache icu-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd opcache \
    && docker-php-ext-enable opcache

#* install de Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

#* installation de composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#* rep de travail
WORKDIR /var/www/html