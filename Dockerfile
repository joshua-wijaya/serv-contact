FROM php:7.4-apache

COPY . /var/ww/html/

RUN apt-get update && apt-get install -y \
  libpng-dev \
  && docker-php-ext-install \
    gd \
    mysqli \
    pdo_mysql \
  && a2enmod rewrite

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]