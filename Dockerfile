FROM php:8.1-alpine

# Cài đặt các phụ thuộc cần thiết
RUN apk --update add --no-cache \
    libpng-dev \
    libxml2-dev \
    librdkafka-dev \
    nodejs \
    npm \
    zip \
    unzip \
    nano \
    gdal \
    oniguruma-dev
    #Instal grpc
RUN apk --update add --no-cache git grpc-cpp grpc-dev $PHPIZE_DEPS && \
        GRPC_VERSION=$(apk info grpc -d | grep grpc | cut -d- -f2) && \
        git clone --depth 1 -b v${GRPC_VERSION} https://github.com/grpc/grpc /tmp/grpc && \
        cd /tmp/grpc/src/php/ext/grpc && \
        phpize && \
        ./configure && \
        make && \
        make install && \
        rm -rf /tmp/grpc && \
        apk del --no-cache git grpc-dev $PHPIZE_DEPS && \
        echo "extension=grpc.so" > /usr/local/etc/php/conf.d/grpc.ini

# Cài đặt các extension cần thiết cho PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets
# Cài đặt Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Cài đặt RoadRunner
COPY --from=ghcr.io/roadrunner-server/roadrunner:2023.1.1 /usr/bin/rr /usr/bin/rr
