FROM php:8.1-apache-buster
MAINTAINER Latheesan Kanesamoorthy (https://twitter.com/LatheesanK)

# Update base system
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && \
    apt-get install --no-install-recommends -y wget curl nano sudo libpng-dev libfreetype6-dev libzip-dev zip unzip
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
RUN sudo apt-get install -y nodejs

# Install & enable required php libraries
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis \
    && docker-php-ext-install -j$(nproc) pcntl zip mysqli pdo_mysql bcmath \
    && docker-php-ext-configure gd --enable-gd --with-freetype \
    && docker-php-ext-install -j$(nproc) gd

# Configure php & apache
RUN cp /usr/local/etc/php/php.ini-production php.ini && \
    rm -rf /etc/apache2/sites-available/* && \
    rm -rf /etc/apache2/sites-enabled/* && \
    echo 'ServerName gatekeeper.app' >> /etc/apache2/apache2.conf
COPY /docker/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY /docker/gatekeeper.app.conf /etc/apache2/sites-available/gatekeeper.app.conf
RUN a2enmod rewrite && \
    a2ensite gatekeeper.app

# Clean-up
RUN sudo apt-get -y purge && sudo apt-get -y clean && \
    sudo apt-get -y autoremove && sudo rm -rf /var/lib/apt/lists/* && \
    sudo rm -rf /usr/bin/apt*

# Create gatekeeper user
RUN adduser --disabled-password --gecos '' gatekeeper && \
    echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers && \
    adduser gatekeeper sudo && \
    chown -R gatekeeper:gatekeeper /home/gatekeeper/.*

# Install composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && rm -f composer-setup.php \
    && mv composer.phar /usr/local/bin/composer

# Set gatekeeper user
USER gatekeeper
WORKDIR /home/gatekeeper/application

# Expose apache port
EXPOSE 80
