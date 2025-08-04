FROM php:8.1-apache

# 1) Install PHP extensions & tools
RUN apt-get update \
 && apt-get install -y libzip-dev libonig-dev unzip git pkg-config \
 && docker-php-ext-install pdo_mysql mbstring zip \
 && rm -rf /var/lib/apt/lists/*

# 2) Enable Apache rewrite & alias modules
RUN a2enmod rewrite alias

# 3) Drop in our custom vhost
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# 4) Copy app code
WORKDIR /var/www/app
COPY . /var/www/app

# 5) Install Composer dependencies
COPY composer.json composer.lock /var/www/app/
RUN php -r "copy('https://getcomposer.org/installer','composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && composer install --no-dev --optimize-autoloader \
 && rm composer-setup.php

EXPOSE 80
CMD ["apache2-foreground"]