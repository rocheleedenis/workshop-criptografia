FROM php:8.1-cli

WORKDIR /app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt update && \
    apt install -y wget netcat && \
    wget -q -O /usr/bin/wait-for https://raw.githubusercontent.com/eficode/wait-for/v2.2.3/wait-for && \
    chmod +x /usr/bin/wait-for

EXPOSE 8000

# ENTRYPOINT [ "php", "app/artisan", "serve" ]
# CMD [ "--host=0.0.0.0" ]