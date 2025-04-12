FROM php:8.2-cli-alpine AS build

ARG UID=${UID}
ARG GID=${GID}

ENV SONAR_SCANNER_VERSION=5.0.1.3006
ENV LANG=pt_BR.UTF-8 \
    LANGUAGE=pt_BR:pt \
    LC_ALL=pt_BR.UTF-8 \
    SONAR_SCANNER_OPTS="-Djava.net.preferIPv4Stack=true" \
    PATH="/opt/sonar-scanner-${SONAR_SCANNER_VERSION}-linux/bin:$PATH"

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    unzip \
    curl \
    linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && printf "zend_extension=xdebug\nxdebug.mode=coverage\nxdebug.start_with_request=yes\n" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/* /tmp/*

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod a+x /usr/local/bin/entrypoint.sh

RUN addgroup -g ${GID} dev
RUN adduser -g ${GID} -u ${UID} -S dev dev
USER dev

WORKDIR /home/dev/app

HEALTHCHECK --interval=30s --timeout=5s --start-period=5s --retries=3 \
    CMD php -v >/dev/null || exit 1

ENTRYPOINT ["entrypoint.sh"]
CMD ["tail", "-f", "/dev/null"]
