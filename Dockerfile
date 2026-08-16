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


# ---------- System packages + PostgreSQL ----------
RUN apk add --no-cache \
    nginx \
    curl \
    git \
    unzip \
    postgresql-dev \
    libzip-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev


# Make sure pg_config can be found
ENV PATH="/usr/bin:$PATH"

RUN which pg_config && pg_config --version


# ---------- PHP extensions ----------
RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    xml \
    bcmath \
    intl \
    zip \
    opcache


# ---------- GD ----------
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install gd


# ---------- Composer ----------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# ---------- Laravel project ----------
COPY . .


# ---------- Frontend build ko Laravel ke public/build mein lao ----------
COPY --from=frontend /app/public/build ./public/build


# ---------- Production PHP dependencies ----------
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction


# ---------- Storage permissions ----------
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache


# ---------- Nginx configuration ----------
COPY docker/nginx.conf /etc/nginx/http.d/default.conf


# ---------- Start script ----------
COPY docker/start.sh /start.sh

RUN chmod +x /start.sh


# ---------- Port ----------
EXPOSE 10000


# ---------- Start Laravel + Nginx ----------
CMD ["/start.sh"]
