<?php

namespace app\assets;

use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * CoreUI.io asset bundle.
 */
class CoreUiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/coreui/coreui/dist';
    public $css = [
        'css/coreui.min.css',
    ];
    public $js = [
        'js/coreui.bundle.min.js',
        'js/coreui-utilities.min.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapPluginAsset::class,
    ];
}
