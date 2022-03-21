FROM php:8.0-apache

WORKDIR /var/www/html

# Update package information
RUN apt-get update \
	&& apt-get upgrade -y \
	&& apt-get install zip -y

# Apache
RUN a2enmod rewrite \
	&& sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Composer
RUN curl -sS https://getcomposer.org/installer \
	| php -- --install-dir=/usr/local/bin --filename=composer

# Laravel
COPY src/ .
RUN chown -R www-data:www-data ./storage

EXPOSE 80
