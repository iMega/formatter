FROM alpine:3.4

RUN apk add --update \
            php5 \
            php5-json \
            php5-dom && \
    rm -rf /var/cache/apk/*

VOLUME ["/app"]

WORKDIR /app

ENTRYPOINT ["/app/vendor/bin/phpunit"]
