FROM php:8.1-apache

LABEL maintainer="Steven Sil"

# Copie des dossiers/fichiers sur le conteneur
COPY .docker/php/php.ini /usr/local/etc/php/
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/
COPY . /var/www/html

# Installation de bibliothèques/logiciels
RUN apt-get update \
    && apt-get install -y \
    libxml2-dev \
    libonig-dev \
    libzip-dev \
    git \
    zsh \
    unzip

# Installation extensions PDO pour MySQL et zip
RUN docker-php-ext-install dom xml mbstring pdo_mysql zip

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Installation de Node.js & NPM
ENV NODE_VERSION=16.13.0
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node -v
RUN npm -v

# Oh My Zsh + alias artisan
RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"
RUN echo 'alias artisan="php artisan"' >> ~/.zshrc

# Configuration de Git
RUN git config --global user.name "Paul-Hil" \
    && git config --global user.email "famhilairep@gmail.com"

# Activation de la réécriture d'URL pour Apache
RUN a2enmod rewrite