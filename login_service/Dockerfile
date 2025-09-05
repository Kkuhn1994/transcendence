FROM debian:latest


RUN apt update && apt install -y \
    lsb-release \
    apt-transport-https \
    ca-certificates \
    curl

RUN curl -sSL https://packages.sury.org/php/README.txt | bash -x

 # Installiere PHP 8.2 und PHP-FPM
RUN apt update && apt install -y php8.2-fpm
COPY login.php var/www/html/.

CMD ["php-fpm8.2", "-F"] 