# Yii2 Boilerplate

## Quick-Start

### Composer installation

You can install _Yii2 Boilerplate_ using [composer](https://getcomposer.org/download/)...

    composer global require "fxp/composer-asset-plugin:1.0.0-beta4"
    composer create-project --stability=dev cornernote/yii2-boilerplate myapp

Create and adjust your environment configuration, eg. add a database...

    cd myapp
    cp .env-dist .env
    edit .env
    
Run the application setup...
    
    ./yii app/setup
    
Open `http://path-to-app/web` or `http://path-to-app/web?r=admin` in your browser.
