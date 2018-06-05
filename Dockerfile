FROM ubuntu:latest

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -yq \
    php \
    software-properties-common \
    php-xml \
    php-mbstring \
    git \
    zip \
    unzip \
    ca-certificates

RUN add-apt-repository ppa:ondrej/php -y

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -yq \
    php7.0-fpm \
    php7.0-mysql \
    php-mysql \
    php7.1-xml

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /workspace/src/github.com/ThomasCaud/fabDB
ADD . /workspace/src/github.com/ThomasCaud/fabDB
RUN mkdir var
RUN cp app/config/parameters.yml.dist app/config/parameters.yml

RUN /composer update