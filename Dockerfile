# Usar a imagem oficial do PHP
FROM php:8.2-cli

# Instalar dependências e extensões
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar arquivos
COPY . .

# Instalar dependências do Composer
RUN composer install

# Expor a porta para o Lumen
EXPOSE 8000

# Iniciar o servidor PHP
CMD php -S 0.0.0.0:8000 -t public
