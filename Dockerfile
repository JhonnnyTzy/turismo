FROM php:8.1-apache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar el código
COPY . /var/www/html/

# Cambiar permisos
RUN chown -R www-data:www-data /var/www/html
