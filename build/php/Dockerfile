FROM pollitofive/php:1.0.0

RUN echo 'alias t="./vendor/phpunit/phpunit/phpunit"' >> ~/.bashrc && echo 'alias tf="./vendor/phpunit/phpunit/phpunit --filter"' >> ~/.bashrc
RUN echo 'alias art="php artisan"' >> ~/.bashrc

RUN echo "chmod 777 -R /var/www/html/"

RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "vim"]

WORKDIR /var/www/html


