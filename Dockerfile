# PHP 8.2 ve Nginx barındıran kararlı ve popüler bir imaj kullanılıyor
FROM richarvey/nginx-php-fpm:latest

# Proje dosyalarını Nginx'in varsayılan web dizinine kopyalanıyor
COPY . /var/www/html

# Render'ın dinamik portunu Nginx yapılandırmasına tanıtılıyor
ENV PORT=80
