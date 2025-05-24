FROM php:8.4-fpm
# Essa imagem é baseada na imagem oficial do PHP 8.4 com FPM (FastCGI Process Manager).
# Porém docker.hub.com identificou ela com 3 vulnerabilidades criticas nessa imagem.
# Como estamos usando apenas para fins de desenvolvimentos vou manter ela, porém não é recomendada para produção.

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    libxslt1-dev \
    zip \
    ca-certificates \
    curl \
    unzip \
    mariadb-client \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl opcache pdo pdo_mysql xml xsl zip \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY ./docker/php-fpm/php.ini /usr/local/etc/php/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

USER www-data