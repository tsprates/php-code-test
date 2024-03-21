FROM php:8.0-apache

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/html

# Update package information
RUN apt-get update && apt-get install -y \
	unzip \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/*

# Apache
RUN a2enmod rewrite \
	&& sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Composer
RUN curl -sS https://getcomposer.org/installer \
	| php -- --install-dir=/usr/local/bin --filename=composer

# Laravel
COPY src/ .
RUN chown -R www-data:www-data ./storage
COPY src/.env.example ./.env
RUN composer dump-autoload \
	&& composer install
RUN php artisan key:generate

EXPOSE 80
