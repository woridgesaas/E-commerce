FROM php:8.4-fpm AS base

RUN apt-get update && apt-get install -y \
    curl git unzip zip librabbitmq-dev \
    g++ make unixodbc-dev \
    && rm -rf /var/lib/apt/lists/*


ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions opcache iconv soap zip intl fileinfo pdo redis mysqli pdo_mysql gd pdo_pgsql amqp

ENV ACCEPT_EULA=Y
RUN pecl install sqlsrv pdo_sqlsrv && \
    docker-php-ext-enable sqlsrv pdo_sqlsrv

FROM base AS build

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN mkdir -p var var/cache var/log vendor \
    && chown -R www-data:www-data var vendor \
    && chmod -R 775 var vendor

FROM base AS prod

WORKDIR /var/www/html

COPY --from=build /usr/bin/composer /usr/bin/composer
COPY --from=build /var/www/html /var/www/html

RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor \
    && chmod -R 775 /var/www/html/var /var/www/html/vendor

USER www-data

CMD ["php-fpm"]
