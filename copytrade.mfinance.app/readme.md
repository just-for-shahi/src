## Docker

- install docker
- run: `docker-compose up -d nginx redis mysql workspace`
- run: `docker-compose exec workspace composer install`
- rename .env.benjamin to .env
- open .env and set
    DB_HOST=mysql
    REDIS_HOST=redis
    DB_PASSWORD=root
    APP_URL=http://localhost


## Deploy

- run `sudo adduser deployer`
- run `sudo mkdir /var/www/html/new-trade-copier`
- run `sudo setfacl -R -m u:deployer:rwx /var/www/html/new-trade-copier`
- if needed install acl: `sudo apt install acl`
- run `php artisan deploy` on docker workspace
- run `sudo chmod 775 /var/www/html/copier/shared/storage`

## SSH key for gitlab to clone without password
- run `ssh-keygen -t ed25519 -C "email@example.com"`
- added generate key to gitlab. use pub key. /home/<username>/.ssh/id_ed25519.pub
- to test added key run `ssh git@gitlab.com`
