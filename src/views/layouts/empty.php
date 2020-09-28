<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$bodyClass = isset($this->params['showSidebar'])
    ? $this->params['showSidebar']
        ? "app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show"
        : "app header-fixed sidebar-fixed aside-menu-fixed"
    : "app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show";

\daxslab\coreui\CoreUiAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.2.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?= Yii::$app->name ?></title>
    <script>
        i18n = {
            'Search': '<?=Yii::t('app', 'Search')?>',
            'Choose': '<?=Yii::t('app', 'Choose')?>',
        };
    </script>
    <?php $this->head() ?>
</head>
<body class="c-app">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
