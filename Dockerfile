FROM php:alpine

ENV PATH="./vendor/bin:${PATH}"

COPY run.sh /usr/local/bin/run.sh
RUN chmod +x /usr/local/bin/run.sh

CMD ["/usr/local/bin/run.sh"]

RUN docker-php-ext-install pdo_mysql && \
    apk add --no-cache bash

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

VOLUME /app
