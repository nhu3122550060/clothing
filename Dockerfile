FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set git safe directory to avoid "dubious ownership" error
RUN git config --global --add safe.directory /var/www/html

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory
COPY . /var/www/html

# Install dependencies
RUN composer install

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www/html

# Expose port 8000 for Tempest development server
EXPOSE 8000

# Start Tempest development server
CMD ["php", "tempest", "serve", "--host=0.0.0.0"]
