FROM dunglas/frankenphp

ENV SERVER_NAME=vehicle-rental.divawidia.my.id

WORKDIR /var/www/vehicle-rental

COPY --chown=www-data:www-data  . .

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libzip-dev \
    zlib1g-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        intl \
        exif \
        pcntl \
        gd \
        bcmath \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Node.js (change version if needed)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN composer require laravel/octane \
    && composer install --no-dev --optimize-autoloader --no-interaction --no-progress \
    && npm install \
    && npm run build

RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan octane:install --server=frankenphp

RUN chown -R www-data:www-data /var/www/vehicle-rental/storage /var/www/vehicle-rental/bootstrap/cache \
    && chmod -R 775 /var/www/vehicle-rental/storage /var/www/vehicle-rental/bootstrap/cache

# Expose port 8000 internally
EXPOSE 8000

# Start Laravel Octane FrankenPHP server binding to all interfaces
ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]