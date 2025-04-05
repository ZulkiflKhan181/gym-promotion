# Use official PHP image with Apache
FROM php:8.1-apache

# Install required system dependencies
RUN apt-get update && apt-get install -y \
libpq-dev \
&& docker-php-ext-install pdo pdo_pgsql

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Expose port 80 for Apache
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
