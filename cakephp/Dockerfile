########### FOR BUILD ##########
FROM composer

WORKDIR /app

RUN composer self-update --1 && composer install --ignore-platform-reqs


########### RUN PROJECT ##########

FROM webdevops/php-apache:7.4

WORKDIR /app

RUN chmod -R 777 .
