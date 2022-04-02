FROM php:8.1.0-fpm

RUN apt-get update && apt-get install -y libpq-dev libldap2-dev libonig-dev openssl locales libzip-dev zip \
    && pecl install redis && docker-php-ext-enable redis \
    && docker-php-ext-install gettext pdo pdo_mysql pdo_pgsql mbstring mysqli bcmath zip

RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/bin/ --filename=composer
