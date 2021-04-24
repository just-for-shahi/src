FROM nginx:latest

RUN apt-get update \
    && apt-get install --assume-yes --no-install-recommends\
    apt-transport-https \
    build-essential \
    bzip2 \
    curl \
    git \
    rlwrap \
    vim \
    && curl -sL https://deb.nodesource.com/setup_10.x | bash - \
    && apt-get install --assume-yes --no-install-recommends nodejs \
    && apt-get clean

COPY . /app
WORKDIR /app
RUN npm install && \
    npm run build

COPY nginx.conf /etc/nginx/

EXPOSE 5000