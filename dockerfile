# Use an official PHP runtime as a parent image
FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql

# Clear the cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application code to the container
COPY . /var/www/html

# Install project dependencies
RUN composer install --no-interaction --no-plugins --no-scripts --no-progress --prefer-dist

# Copy environment file
COPY .env.example .env

# Generate application key
RUN php artisan key:generate

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

#########################################################################

# # Use the official PHP image as base
# FROM php:7.4-fpm

# # Install dependencies
# RUN apt-get update && apt-get install -y \
#     build-essential \
#     libpng-dev \
#     libjpeg62-turbo-dev \
#     libfreetype6-dev \
#     locales \
#     zip \
#     jpegoptim optipng pngquant gifsicle \
#     vim \
#     unzip \
#     git \
#     curl

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# # Install extensions
# # RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
# RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
# RUN docker-php-ext-install gd

# # Install composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Set working directory
# WORKDIR /employ-manag

# # Copy existing application directory contents
# COPY . .

# # Copy existing application directory permissions
# COPY --chown=www-data:www-data . /employ-manag/

# # Change current user to www
# USER www-data

# # Expose port 9000 and start php-fpm server
# EXPOSE 9000
