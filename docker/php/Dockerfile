FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        wget git unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libicu-dev \
        libpq-dev \
        zlib1g-dev \
        libzip-dev \
	    curl \
	    libzip-dev \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install intl \
    && docker-php-ext-install shmop \
    && docker-php-ext-install -j$(nproc) exif \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath

WORKDIR /var/www

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
RUN chmod 777 /var/log
COPY conf.ini $PHP_INI_DIR/conf.d/

RUN usermod -u 1000 www-data
