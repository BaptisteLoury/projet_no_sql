FROM httpd:latest
RUN apt-get update
RUN apt-get -y install php libapache2-mod-php php-pgsql
COPY . /var/www/html
EXPOSE 8080


