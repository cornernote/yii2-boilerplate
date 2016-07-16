# Yii2 Boilerplate

## Quick-Start

### Composer installation

Install global composer

```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```


You can install _Yii2 Boilerplate_ using [composer](https://getcomposer.org/download/)...

```
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer create-project --stability=dev cornernote/yii2-boilerplate myapp
```

Create and adjust your environment configuration, eg. add a database...

```
cd myapp
cp .env-dist .env
edit .env
```
    
Run the application setup...
    
```
./yii app/setup
```

Install robo...

```
wget http://robo.li/robo.phar
mv robo.phar /usr/local/bin/robo
```

Start a webserver...

```
robo server --port=80 --path web/
```

Open `http://path-to-app/web` or `http://path-to-app/web?r=admin` in your browser.

Install psysh

```
wget psysh.org/psysh
mv psysh /usr/local/bin/psysh
```

Code Generation

```
./yii gii-batch --tables=t1,t2
./yii gii-batch/models --tables=t1,t2
./yii gii-batch/cruds --tables=t1,t2
```
