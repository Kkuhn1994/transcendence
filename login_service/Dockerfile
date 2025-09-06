# FROM debian:latest


# RUN apt update && apt install -y \
#     lsb-release \
#     apt-transport-https \
#     ca-certificates \
#     curl

# RUN curl -sSL https://packages.sury.org/php/README.txt | bash -x

#  # Installiere PHP 8.2 und PHP-FPM
# RUN apt update && apt install -y php8.2-fpm
# # COPY login.php var/www/html/.
# RUN apt install -y sqlite3 libsqlite3-dev \
#     && docker-php-ext-install pdo pdo_sqlite
# COPY www.conf /etc/php/8.2/fpm/pool.d/www.conf

# CMD ["php-fpm8.2", "-F"] 
FROM php:8.2-fpm

# Installiere die benötigten Bibliotheken für SQLite
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite


# Stelle sicher, dass php-fpm gestartet wird
CMD ["php-fpm"]