FROM php:7.3.3-fpm-alpine3.9

# TODO SWITCH USER!!! note also change laravel path dir from root to appuser
#RUN groupadd -g 999 appuser && \
#    useradd -r -u 999 -g appuser appuser
#USER appuser

#downloaded from : https://dl.bintray.com/php-alpine/v3.9/php-7.3 /
#https://github.com/codecasts/php-alpine
RUN mkdir /var/apk

ADD ./apk /var/apk

#add zip extension from official repo
RUN apk add --no-cache zlib-dev libzip-dev
RUN docker-php-ext-install zip

RUN apk add --allow-untrusted /var/apk/php7-common-7.3.3-r1.apk
RUN apk add --allow-untrusted /var/apk/php7-openssl-7.3.3-r1.apk
RUN apk add --allow-untrusted /var/apk/php7-pdo-7.3.3-r1.apk
RUN apk add --allow-untrusted /var/apk/php7-mysqlnd-7.3.3-r1.apk
RUN apk add --allow-untrusted /var/apk/php7-pdo_mysql-7.3.3-r1.apk
#RUN apk add --allow-untrusted /var/apk/php7-mysqli-7.3.3-r1.apk
RUN apk add --allow-untrusted /var/apk/php7-gd-7.3.3-r1.apk
#RUN apk add --allow-untrusted /var/apk/php7-phalcon-3.4.2-r1.apk

#RUN apk add --no-cache zip zlib-dev
#RUN docker-php-ext-configure zip --with-zlib-dir=/usr/include
#RUN docker-php-ext-install zip

RUN rm -R /var/apk

RUN mv -v /usr/lib/php7/modules/* /usr/local/lib/php/extensions/no-debug-non-zts-20180731/
RUN mv -v /etc/php7/conf.d/* /usr/local/etc/php/conf.d/

COPY ./php.ini /usr/local/etc/php/php.ini

#
#   Package managers
#

#add composer
RUN apk add --update composer

#install laravel command
RUN composer global require laravel/installer

#add laravel command ( to PATH )
ENV PATH "$PATH:/root/.composer/vendor/bin:$PATH"

#composer config --list --global

#add npm
#RUN apk add --update nodejs nodejs-npm


#add yarn
#RUN npm install -g yarn

#RUN mkdir /phalcon-devtools
#COPY ./composer/phalcon-devtools/composer.json /phalcon-devtools/composer.json

#install the devtools using composer
#RUN composer install -d /phalcon-devtools

#create a symlink so the devtools can be used while entering the container
#RUN ln -s /phalcon-devtools/vendor/phalcon/devtools/phalcon.php /usr/bin/phalcon
#mark executable
#RUN chmod ugo+x /usr/bin/phalcon

WORKDIR /code