FROM gitpod/workspace-base

RUN sudo apt-get update \
    && sudo apt-get install -y curl unzip php7.4-cli php-xdebug php-mbstring php-curl php-dom

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php \
    && sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -f /tmp/composer-setup.php


