<?php
use app\assets\AppAsset;
use app\widgets\PreventDoubleSubmit;

//$viewSidebar = '@app/views/layouts/_sidebar';

AppAsset::register($this);
PreventDoubleSubmit::widget();

$regex = '|(\\' . DIRECTORY_SEPARATOR . '[^\\' . DIRECTORY_SEPARATOR . ']*\\' . DIRECTORY_SEPARATOR . '[^\\' . DIRECTORY_SEPARATOR . ']*\.php)$|';
preg_match($regex, __FILE__, $matches);
require(Yii::getAlias('@vendor/cornernote/yii2-ace/src/views' . $matches[1]));
