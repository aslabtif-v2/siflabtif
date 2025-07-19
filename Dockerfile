FROM php:5.6.40-apache

COPY ./lib /usr/lib/x86_64-linux-gnu
COPY ./ext /usr/local/lib/php/extensions/no-debug-non-zts-20131226

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./etc/php/conf.d /usr/local/etc/php/conf.d

COPY ./app /var/www/html

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80
