FROM php:latest
WORKDIR /test
COPY . /test
RUN php tests/sample-test.php