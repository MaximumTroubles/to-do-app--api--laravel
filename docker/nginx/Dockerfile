FROM nginx:latest

RUN apt-get update && apt-get install -y nano

RUN deluser www-data
RUN adduser --disabled-password --no-create-home --uid 1000 --shell /bin/bash www-data

COPY ./nginx.conf /etc/nginx/conf.d/default.conf
COPY dev.shop.com.crt /etc/ssl/certs/dev.shop.com.crt
COPY dev.shop.com.key /etc/ssl/private/dev.shop.com.key

ENV TERM xterm
