FROM php:7.2-apache
#RUN apt-get update
#RUN apt-get -y install php libapache2-mod-php php-pgsql
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pgsql pdo pdo_pgsql
COPY ./src/ /var/www/html
#EXPOSE 8080


