FROM nginx:1.20

ADD ./vhost.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www