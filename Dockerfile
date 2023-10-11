# This example will work with application root directory as docker context
FROM php:8.2-cli-alpine3.17 as backend

RUN  --mount=type=bind,from=mlocati/php-extension-installer:1.5,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
      install-php-extensions opcache zip xsl dom exif intl pcntl bcmath sockets && \
     apk del --no-cache  ${PHPIZE_DEPS} ${BUILD_DEPENDS}

WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer
COPY ./composer.* .
RUN composer config --no-plugins allow-plugins.spiral/composer-publish-plugin false && \
    composer install --optimize-autoloader

EXPOSE 8080/tcp

COPY ./ .

COPY --from=spiralscout/roadrunner:latest /usr/bin/rr /app

CMD ./rr serve -c .rr.yaml
