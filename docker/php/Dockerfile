FROM php:7.4-fpm-alpine

# Install Extensions
RUN docker-php-source extract \
 && docker-php-ext-configure opcache \
 && docker-php-ext-install opcache \
 && docker-php-source delete

# Change User-ID of www-data
RUN apk add --no-cache --update shadow \
 && usermod -u 1000 www-data \
 && groupmod -g 1000 www-data \
 && usermod -d /app www-data

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer \
 && composer self-update

RUN mkdir /app && chown www-data:www-data /app
WORKDIR /app

USER www-data
COPY --chown=www-data:www-data ./composer* /app/
RUN composer install --no-progress --prefer-dist
USER root

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY --chown=www-data:www-data ./ /app/
