FROM wordpress:6.6.2-php8.3-fpm-alpine

RUN apk update \
    && apk upgrade \
    && apk add nginx \
    && apk add memcached \
    && apk add libmemcached-libs \
    && apk add zlib \
    && rm -rf /usr/src/wordpress/wp-content/themes/* \
    && rm -rf /usr/src/wordpress/wp-content/plugins/* \
    && mkdir dir /usr/src/wordpress/wp-content/themes/jojo


ADD deploy/php.ini /usr/local/etc/php/
ADD deploy/default.conf /etc/nginx/http.d/
ADD deploy/run.sh /usr/local/bin/

ADD --chown=www-data:www-data . /usr/src/wordpress/wp-content/themes/jojo

RUN set -xe && \
    cd /tmp/ && \
    apk add --update --virtual .phpize-deps $PHPIZE_DEPS && \
    apk add --update --virtual .memcached-deps zlib-dev libmemcached-dev cyrus-sasl-dev && \
    pecl install igbinary && \
    ( \
        pecl install --nobuild memcached && \
        cd "$(pecl config-get temp_dir)/memcached" && \
        phpize && \
        ./configure --enable-memcached-igbinary && \
        make -j$(nproc) && \
        make install && \
        cd /tmp/ \
    ) && \
    docker-php-ext-enable igbinary memcached && \
    rm -rf /tmp/* && \
    apk del .memcached-deps .phpize-deps

RUN touch /run/nginx/nginx.pid
RUN rm -rf /usr/src/wordpress/deploy
RUN chmod 755 /usr/local/bin/run.sh
RUN curl -O https://downloads.wordpress.org/plugin/wpjam-basic.zip \
    && unzip -q wpjam-basic.zip -d /usr/src/wordpress/wp-content/plugins/ \
    && rm -rf wpjam-basic.zip \
    && cp -rfp /usr/src/wordpress/wp-content/plugins/wpjam-basic/template/object-cache.php /usr/src/wordpress/wp-content/

#RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \ 
#    && chmod +x wp-cli.phar \
#    && mv wp-cli.phar /usr/local/bin/wp

EXPOSE 80 

WORKDIR /usr/src/wordpress

ENTRYPOINT ["run.sh"]
