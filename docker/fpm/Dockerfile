FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install pcntl posix \
    && apt-get install -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apt-get install -y zip unzip \
    && apt-get install -y git \
    && apt-get install -y nano \
    && pecl install  -f xdebug-2.9.8 \
    && docker-php-ext-enable xdebug 

RUN touch /tmp/xdebug.log && chmod 777 /tmp/xdebug.log

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | \
            php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get update && apt-get -y install yarn

ARG UID
ARG USER_NAME

RUN useradd -m -u ${UID} -g root ${USER_NAME}

RUN cd /usr/local/etc/php && cp php.ini-development php.ini
