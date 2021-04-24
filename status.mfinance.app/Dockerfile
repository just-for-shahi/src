FROM ubuntu:20.04

LABEL maintainer="Taylor Otwell"

WORKDIR /var/www/html

ENV WWWUSER=1000
ENV WWWGROUP=1000
ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 policycoreutils-python-utils\
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu focal main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php7.1-cli php7.1-dev \
    php7.1-pgsql php7.1-sqlite3 php7.1-gd \
    php7.1-curl php7.1-memcached \
    php7.1-imap php7.1-mysql php7.1-mbstring \
    php7.1-xml php7.1-zip php7.1-bcmath php7.1-soap \
    php7.1-intl php7.1-readline \
    php7.1-msgpack php7.1-igbinary php7.1-ldap \
    php7.1-redis php7.1-imagick \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_15.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get install -y mysql-client \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php7.1

RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u $WWWUSER sail


COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php/7.1/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

COPY . .
RUN chmod -R 777 storage bootstrap/cache \
    && chown -R $WWWUSER:$WWWGROUP . \
    && gosu $WWWUSER cp .env.example .env \
    && gosu $WWWUSER composer install --no-dev -o


EXPOSE 5000

ENTRYPOINT ["start-container"]
