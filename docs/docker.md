# Docker Install

Create the empty composer files.

```shell script
echo {} > composer.json && echo {} > composer.lock
```

Create an docker-compose application definition.

`cat > docker-compose.yml` (paste from below, the `CTRL+D`)

```yaml
version: '3'
services:
  php:
    image: cornernote/php
    ports:
      - 80:80
    volumes:
      - ./composer.json:/app/composer.json
      - ./composer.lock:/app/composer.lock
      - ./src:/app
```

Start the container.
    
```shell script
docker-compose up -d
```

Run composer require inside the container.

```shell script
docker-compose exec php composer create-project --stability=dev cornernote/yii2-boilerplate /app/tmp && \
docker-compose exec php mv /app/tmp/* /app
```
