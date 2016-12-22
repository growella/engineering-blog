FROM php:7-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
        git autoconf g++ libtool make imagemagick-dev \
        libmemcached-dev libjpeg-turbo-dev libpng-dev zlib-dev cyrus-sasl-dev \
    && docker-php-source extract \
    && git clone --branch php7 \
        https://github.com/php-memcached-dev/php-memcached \
        /usr/src/php/ext/memcached/ \
    && docker-php-ext-configure memcached \
    && docker-php-ext-install memcached \
    && pecl install redis imagick \
    && docker-php-ext-install pdo pdo_mysql mysqli gd zip \
        iconv fileinfo xmlreader xmlwriter spl opcache \
    && docker-php-ext-enable redis imagick \
    && rm -rf /usr/src/php/ext/memcached \
    && docker-php-source delete \
    && apk del .build-deps \
    && apk add --no-cache imagemagick libmemcached

ARG INSTALL_XDEBUG=true
ENV INSTALL_XDEBUG ${INSTALL_XDEBUG}

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    apk add --no-cache --virtual .build-deps autoconf g++ make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps \
;fi

CMD ["php-fpm"]

EXPOSE 9000