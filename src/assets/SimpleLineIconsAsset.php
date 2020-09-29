<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Simple Line Icons (simplelineicons.github.io) asset bundle.
 */
class SimpleLineIconsAsset extends AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@npm/simple-line-icons';

    /**
     * @inherit
     */
    public $css = [
        'css/simple-line-icons.css',
    ];
}