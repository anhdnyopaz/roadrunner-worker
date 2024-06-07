FROM infoecnet/php8.1-laravel-alpine:v1
COPY . /app
WORKDIR /app
EXPOSE 8080
CMD ["rr", "serve"]
