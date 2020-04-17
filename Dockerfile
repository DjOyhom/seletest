FROM php:latest
WORKDIR /test
COPY . /test
ENTRYPOINT ["./entrypoint.sh"]