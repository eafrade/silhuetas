FROM php:8.2-cli

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y locales zip \
    && echo "pt_BR.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen pt_BR.UTF-8 \
    && update-locale LANG=pt_BR.UTF-8

ENV LANG=pt_BR.UTF-8 \
    LANGUAGE=pt_BR:pt \
    LC_ALL=pt_BR.UTF-8

RUN useradd -ms /bin/bash dev

WORKDIR /home/dev/app

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ARG UID=1000
ARG GID=1000
USER dev

HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD php -r "exit(0);"

ENTRYPOINT ["entrypoint.sh"]
CMD ["tail", "-f", "/dev/null"]
