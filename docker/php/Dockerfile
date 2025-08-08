FROM php:7.4.9-fpm

# Debianアーカイブミラー設定
RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list \
    && sed -i '/security/d' /etc/apt/sources.list

# PHP拡張と必要パッケージをインストール
RUN apt update \
    && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip curl git \
    && docker-php-ext-install pdo_mysql zip

# ✅ Composer インストール（ここが重要）
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

COPY php.ini /usr/local/etc/php/
WORKDIR /var/www