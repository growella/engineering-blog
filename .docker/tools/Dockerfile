FROM mobeus/phpfpm:latest

RUN apk add --no-cache ncurses

# Install Composer.
RUN curl \
    https://getcomposer.org/composer.phar \
    > /tmp/composer.phar \
    && chmod +x /tmp/composer.phar \
    && mv /tmp/composer.phar /usr/local/bin/composer

# Install WP-CLI.
RUN curl \
    https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    > /tmp/wp-cli.phar \
    && chmod +x /tmp/wp-cli.phar \
    && mv /tmp/wp-cli.phar /usr/local/bin/wp

CMD [ "true" ]