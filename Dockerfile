FROM ubuntu:latest

RUN add-apt-repository ppa:ondrej/php -y

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -yq \
    php7.1 \
    software-properties-common \
    php7.1-xml \
    php-mbstring \
    git \
    zip \
    unzip \
    ca-certificates \
    php7.1-fpm \
    php7.1-mysql \
    php-mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /workspace/src/github.com/ThomasCaud/fabDB
ADD . /workspace/src/github.com/ThomasCaud/fabDB
RUN mkdir var
RUN cp app/config/parameters.yml.dist app/config/parameters.yml

RUN /composer update