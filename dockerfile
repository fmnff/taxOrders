FROM php:8-apache
MAINTAINER Phil Artamonov

USER root

RUN apt-get update

COPY ./taxOrders /var/www/html/
RUN chown www-data log.txt