<?php

use yii\bootstrap4\Modal;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Markdown;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

$this->params['top-menu'] = isset($this->params['top-menu']) ? $this->params['top-menu'] : [];
$this->params['left-menu'] = isset($this->params['left-menu']) ? $this->params['left-menu'] : [];
$this->params['user-menu'] = isset($this->params['user-menu']) ? $this->params['user-menu'] : [];

$homeUrl = isset(Yii::$app->params['index-url']) ? Yii::$app->params['index-url'] : Yii::$app->homeUrl;
$logoUrl = isset(Yii::$app->params['logo-url']) ? Yii::$app->params['logo-url'] : Yii::getAlias('@web/images/logo.png');
$logoResponsiveUrl = isset(Yii::$app->params['logo-responsive-url']) ? Yii::$app->params['logo-responsive-url'] : Yii::getAlias('@web/images/logo-responsive.png');
$iconUrl = isset(Yii::$app->params['icon-url']) ? Yii::$app->params['icon-url'] : 'https://coreui.io/demo/3.2.0/assets/brand/coreui-pro.svg#full';

$controller = $this->context->id;
$action = $this->context->action->id;

$helpFile = FileHelper::localize(Yii::getAlias("@app/help/{$controller}-{$action}.md"));

if (isset($this->params['breadcrumbs']) && file_exists($helpFile)) {

    $helpButton = Html::a(Yii::t('app', '{icon} Help', [
        'icon' => Html::tag('i', null, ['class' => 'icon-question']),
    ]), '#modal-help', [
        'class' => 'btn',
        'data-toggle' => 'modal',
    ]);

    $rightOptionsContainer = Html::tag('div', $helpButton, [
        'class' => 'btn-group',
        'role' => 'group',
        'aria-label' => 'Button group',
    ]);

    $this->params['breadcrumbs'][] = Html::tag('li', $rightOptionsContainer, [
        'class' => 'breadcrumb-menu d-md-down-none'
    ]);
}

?>

<?php $this->beginContent('@app/views/layouts/empty.php') ?>

    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <a href="<?= $homeUrl ?>" class="c-sidebar-brand d-lg-down-none">
            <img class="c-sidebar-brand-full" src="<?= $logoUrl ?>" alt="<?= Yii::$app->name ?>">
            <img class="c-sidebar-brand-minimized" src="<?= $iconUrl ?>" alt="<?= Yii::$app->name ?>">
        </a>
        <?= \yii\widgets\Menu::widget([
            'items' => $this->params['left-menu'],
            'encodeLabels' => false,
            'options' => [
                'class' => 'c-sidebar-nav'
            ],
            'linkTemplate' => '<a class="c-sidebar-nav-link" href="{url}">{label}</a>',
            'itemOptions' => [
                'class' => 'c-sidebar-nav-item'
            ]
        ]) ?>

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <i class="c-icon c-icon-lg icon-menu"></i>
            </button>
            <a class="c-header-brand d-lg-none" href="<?= $homeUrl ?>">
                <img src="<?= $logoResponsiveUrl ?>" alt="<?= Yii::$app->name ?>">
            </a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
                <i class="c-icon c-icon-lg icon-menu"></i>
            </button>
            <?= \yii\bootstrap4\Nav::widget([
                'id' => 'top-menu',
                'encodeLabels' => false,
                'options' => ['class' => 'c-header-nav ml-auto mr-4'],
                'items' => array_merge($this->params['top-menu'], $this->params['user-menu']),
            ]) ?>
            <div class="c-subheader px-3">
                <?= Breadcrumbs::widget([
                    'options' => ['class' => 'breadcrumb border-0 m-0'],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                    'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                    'encodeLabels' => false,
                ])
                ?>
            </div>
        </header>
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        <?= $content ?>
                    </div>
                </div>
            </main>
            <footer class="c-footer">
                <div>
                    <a href="<?= Yii::$app->request->hostInfo ?>"><?= Yii::$app->name ?></a>
                    <span>&copy; 2018 <?= Yii::t('app', 'All rights reserved') ?>.</span>
                </div>
                <div class="ml-auto">
                    <?= Yii::t('app', 'By {vendor} with {icon}', [
                        'vendor' => Html::a('Daxslab', 'http://daxslab.com', ['target' => '_blank']),
                        'icon' => Html::tag('i', null, [
                            'class' => 'icon-heart text-danger'
                        ]),
                    ]) ?>
                </div>
            </footer>
        </div>
    </div>
<?php $this->endContent() ?>

<?php if (file_exists($helpFile)): ?>

    <?php Modal::begin(['id' => 'modal-help',
        'title' => Yii::t('app', 'Help on {title}', ['title' => $this->title]),
        'size' => Modal::SIZE_LARGE,]) ?>

    <?= Markdown::process($this->renderFile($helpFile)) ?>

    <?php Modal::end() ?>

<?php endif; ?>