RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

CMD [ "php", "-S", "0.0.0.0:80" ]

EXPOSE 80

yorum satiri 1
