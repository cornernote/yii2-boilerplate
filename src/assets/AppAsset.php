<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Application asset bundle.
 */
class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $sourcePath = '@app/assets/web';

    public $css = [
        'css/yii-coreui.css',
        'css/app.css',
    ];
    public $js = [
        'js/app.js',
    ];
    public $depends = [
        CoreUiAsset::class,
        SimpleLineIconsAsset::class,
    ];
}
