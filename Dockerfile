FROM php:8.4-cli

# 🧱 Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    iproute2 \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ⚙️ Instalar extensiones de PHP
# Añadimos 'intl' para Filament y 'bcmath' para cálculos precisos
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl gd bcmath intl

# 🚀 Instalar extensión de Redis (Vital para Event-Driven)
RUN pecl install redis && docker-php-ext-enable redis

# 🧰 Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 🧪 Instalar Node.js (V20 LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app

# 🔐 Permisos y optimización
# Nota: COPY . . solo copiará lo que esté en el contexto de construcción definido en el compose
COPY . .

RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
