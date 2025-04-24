#Utiliser une image PHP officielle avec les extensions nécessaires
FROM php:8.3-fpm

#Définir le répertoire de travail
WORKDIR /app

#Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    netcat-openbsd \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

#Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#Copier les fichiers de l'application dans le conteneur
COPY . .

#Installer les dépendances PHP (si non déjà installées sur le host)
RUN composer install --no-interaction --optimize-autoloader

#Ouvrir le port 8000
EXPOSE 8000

COPY wait-for-mysql.sh /wait-for-mysql.sh
RUN chmod +x /wait-for-mysql.sh
CMD ["/wait-for-mysql.sh"]

