# Use official PHP image with Apache
FROM php:8.2-apache

# Copy app code to Apache's document root
COPY . /var/www/html/

# Install MySQLi extension
RUN docker-php-ext-install mysqli


#Expose port 80 (already done in docker-compose)
EXPOSE 80
