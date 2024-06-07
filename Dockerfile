FROM php:8.1-alpine
COPY . /app
WORKDIR /app
RUN composer install
CMD ["rr", "serve"]
