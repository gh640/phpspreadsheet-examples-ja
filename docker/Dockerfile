FROM php:7.3-cli

ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /app

RUN apt-get update && \
    apt-get install -y \
      g++ libbz2-dev libfreetype6-dev libicu-dev libmcrypt-dev libxml2-dev \
      libzip-dev zlib1g-dev locales wget && \
    apt-get autoclean && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ && \
    docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install -j$(nproc) gd mbstring zip && \
    localedef -f UTF-8 -i ja_JP ja_JP.UTF-8

ENV LANG="ja_JP.UTF-8" \
    LANGUAGE="ja_JP:ja" \
    LC_ALL="ja_JP.UTF-8" \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1 \
    PATH="/root/.composer/vendor/bin:$PATH"

COPY docker/install-composer.sh /tmp/
RUN . /tmp/install-composer.sh

