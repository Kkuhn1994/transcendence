FROM php:8.2-fpm

# Installiere die benötigten Bibliotheken für SQLite
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Stelle sicher, dass php-fpm gestartet wird
CMD ["php-fpm"]