FROM php:7.4.19-fpm

# Pre-repository setup: Add support for HTTPS repositories
RUN apt-get update -q; \
    apt-get install -qy apt-transport-https

# Install dependencies
RUN apt-get update && apt-get install -y default-mysql-client

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql opcache

WORKDIR /var/www