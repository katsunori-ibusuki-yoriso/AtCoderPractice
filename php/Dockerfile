# php/Dockerfile
FROM php:latest

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /usr/src/app

# Composer dependencies をインストール
COPY composer.json /usr/src/app/
COPY phpunit.xml /usr/src/app/
RUN composer install

# PHPソースコードのコピー
COPY src /usr/src/app/src
