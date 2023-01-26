FROM php:8.1-cli

WORKDIR /app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 8000

# ENTRYPOINT [ "php", "app/artisan", "serve" ]
# CMD [ "--host=0.0.0.0" ]