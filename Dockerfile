# Imagem base do PHP 8.4
FROM php:8.4-apache

# Argumentos de build
ARG user=laravel
ARG uid=1000

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Obter Composer mais recente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar usuário do sistema
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . /var/www/html

# Copiar arquivo de configuração do PHP
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Configurar Apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Definir permissões
RUN chown -R $user:$user /var/www/html && \
    chmod -R 755 /var/www/html/storage

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Otimizar Laravel
RUN php artisan optimize
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expor porta 8080 (Railway usa esta porta por padrão)
EXPOSE 8080

# Configurar variável de ambiente para o Railway
ENV PORT=8080

# Script de inicialização
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Comando para iniciar o Apache
CMD ["/usr/local/bin/start.sh"]