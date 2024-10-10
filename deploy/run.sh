#!/bin/sh

# start memcached
memcached -d --user=root -m 64
# start php-fpm
php-fpm -D
# start nginx
nginx -g 'daemon off;'