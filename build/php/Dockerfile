FROM pollitofive/php:1.0.0

RUN echo 'alias t="./vendor/phpunit/phpunit/phpunit"' >> ~/.bashrc && echo 'alias tf="./vendor/phpunit/phpunit/phpunit --filter"' >> ~/.bashrc
RUN echo 'alias art="php artisan"' >> ~/.bashrc
RUN echo 'alias nrd="npm run dev"' >> ~/.bashrc

RUN echo "chmod 777 -R /var/www/html/"

RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "vim"]

RUN apt-get -y install curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_11.x  | bash -
RUN apt-get -y install nodejs
RUN npm install


WORKDIR /var/www/html


