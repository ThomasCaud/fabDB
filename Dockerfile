cat Dockerfile 
FROM ubuntu:latest

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -yq \
    php \
    php-xml \
    php-mbstring \
    git \
    zip \
    unzip \
    ca-certificates

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

WORKDIR /workspace/src/github.com/ThomasCaud/fabDB
ADD . /workspace/src/github.com/ThomasCaud/fabDB
RUN cp app/config/parameters.yml.dist app/config/parameters.yml

RUN /composer.phar install