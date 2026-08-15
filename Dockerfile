# ---------- Frontend build ----------
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./

RUN npm run build


# ---------- Laravel / PHP ----------
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    nginx \
    curl \
    git \
    unzip \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    xml \
    bcmath \
    intl \
    zip \
    opcache \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install gd

# Composer install
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Laravel project
COPY . .

# Frontend build ko Laravel ke public/build mein lao
COPY --from=frontend /app/public/build ./public/build

# Production PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Storage permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# Nginx configuration
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Start script
COPY docker/start.sh /start.sh

RUN chmod +x /start.sh

EXPOSE 10000

CMD ["/start.sh"]
