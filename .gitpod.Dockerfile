FROM gitpod/workspace-base

RUN sudo apt-get update \
    && sudo apt-get install -y php7.4-cli php-xdebug php-mbstring


