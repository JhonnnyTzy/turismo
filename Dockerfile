FROM php:8.1-apache

# Copia todos los archivos al servidor
COPY . /var/www/html/

# Da permisos a los archivos
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto 80 para acceso web
EXPOSE 80
