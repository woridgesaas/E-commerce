FROM php:8.4-fpm as build

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    curl \
    git \
    wget \
    bash \
    && rm -rf /var/lib/apt/lists/*
#tool to install extensions ez
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

#extensions
RUN install-php-extensions opcache iconv soap zip intl fileinfo pdo redis mysqli pdo_mysql gd

#install composer and install deps
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .
#Execute symfony scripts (composer.json)
RUN php bin/console cache:clear
RUN mkdir -p var vendor && chown -R www-data:www-data var vendor && chmod -R 775 var vendor

FROM php:8.4-fpm as prod

WORKDIR /var/www/html
COPY --from=build /usr/bin/composer /usr/bin/composer
COPY --from=build /var/www/html /var/www/html


USER www-data
CMD ["php-fpm"]
