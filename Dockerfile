# Use a imagem PHP com Apache
FROM php:7.4-apache

# Instale as dependências necessárias
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev

# Instale as extensões PHP necessárias
RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install zip

# Instale as extensões PDO MySQL e MySQLi
RUN docker-php-ext-install pdo_mysql mysqli

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Ative os módulos Apache necessários para o Laravel
RUN a2enmod rewrite

# Reinicie o Apache
RUN service apache2 restart

# Configuração do Composer para permitir o plugin bloqueado
RUN composer config --global --no-plugins allow-plugins.kylekatarnls/update-helper true

# Defina o diretório de trabalho
WORKDIR /var/www/html
