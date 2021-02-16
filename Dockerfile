FROM php:7.4-cli as cli

RUN apt-get update && apt-get install -y git unzip curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version


FROM cli
COPY . /var/www/
WORKDIR /var/www/

RUN composer install
