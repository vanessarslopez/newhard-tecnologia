FROM node:latest AS node
FROM composer:latest AS composer
FROM php:7.4-apache
RUN apt-get update \
  && apt-get install --yes --no-install-recommends libpq-dev git libzip-dev unzip zip vim \
  && docker-php-ext-install pdo_pgsql pdo_mysql zip

# Instalando node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
# Instalando composer
COPY --from=composer /usr/bin/composer /usr/bin/composer


# Configurando apache para que apunte al directorio correcto
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
