FROM nginx:stable-alpine

RUN rm /etc/nginx/conf.d/default.conf


COPY ./infra/nginx/default.conf.template /etc/nginx/templates/default.conf.template

COPY ./public /var/www/html/public
