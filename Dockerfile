FROM cornernote/php

# Prepare composer
#ADD ./build/composer/config.json /root/.composer/config.json

# Install packages first
ADD ./composer.lock /app/composer.lock
ADD ./composer.json /app/composer.json
RUN /usr/local/bin/composer install --prefer-dist --optimize-autoloader

# Add application code
ADD . /app

# Easy PaaS setup
ENV DB_ENV_MYSQL_DATABASE test
