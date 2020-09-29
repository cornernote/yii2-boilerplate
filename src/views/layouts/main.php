<?php

use cebe\gravatar\Gravatar;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Markdown;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

/**
 * @var $this \yii\web\View
 * @var $content string
 */


$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$helpFile = FileHelper::localize(Yii::getAlias("@app/help/{$controller}/{$action}.md"));

$topMenu = [];
if (file_exists($helpFile)) {
    $topMenu[] = [
        'label' => Yii::t('app', '{icon} Help', [
            'icon' => Html::tag('i', null, ['class' => 'icon-question']),
        ]),
        'url' => '#modal-help',
        'linkOptions' => [
            'data-toggle' => 'modal',
        ],
        'options' => [
            'class' => 'c-header-nav-item',
        ],
    ];
}

// user menu
$user = Yii::$app->user;
if ($user->isGuest) {
    $topMenu[] = [
        'label' => Yii::t('app', 'Login'),
        'url' => ['/user/security/login'],
        'options' => [
            'class' => 'c-header-nav-item btn btn-sm btn-secondary',
        ],
    ];
} else {
    $topMenu[] = [
        //'label' => '<div class="c-avatar"><img class="c-avatar-img" src="https://coreui.io/demo/3.2.0/assets/img/avatars/6.jpg" alt="user@email.com"></div>',
        'label' => Html::tag('div', Gravatar::widget([
            'email' => $user->identity->profile->gravatar_email ?: $user->identity->email,
            'options' => [
                'alt' => $user->identity->username,
                'class' => 'c-avatar-img',
            ],
            'size' => 36,
            'secure' => true,
        ]), [
            'class' => 'c-avatar',
        ]),
        'options' => [
            'class' => 'c-header-nav-item',
        ],
        'linkOptions' => [
            'class' => 'c-header-nav-link',
        ],
        'dropdownOptions' => [
            'class' => 'dropdown-menu-right pt-0',
        ],
        'items' => [
            ['label' => 'Admin'],
            [
                'label' => Yii::t('app', 'Users'),
                'url' => ['/user/admin/index'],
            ],
            [
                'label' => Yii::t('app', 'Roles'),
                'url' => ['/user/role/index'],
            ],
            [
                'label' => Yii::t('app', 'Permissions'),
                'url' => ['/user/permission/index'],
            ],
            [
                'label' => Yii::t('app', 'Rules'),
                'url' => ['/user/rule/index'],
            ],
            ['label' => 'Account'],
            [
                'label' => Yii::t('app', 'Settings'),
                'url' => ['/user/settings/account'],
            ],
            //[
            //    'label' => Yii::t('app', 'Profile'),
            //    'url' => ['/user/profile/index'],
            //],
            [
                'label' => Yii::t('app', 'Logout'),
                'url' => ['/user/security/logout'],
                'linkOptions' => [
                    'data-method' => 'post',
                ],
            ],
        ],
    ];
}
?>

<?php $this->beginContent('@app/views/layouts/minimal.php') ?>

    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <a href="<?= Yii::$app->homeUrl ?>" class="c-sidebar-brand d-md-down-none">
            <span class="c-sidebar-brand-full">
                <?php /*
                <img src="<?= Yii::getAlias('@web/logo.png') ?>" style="max-height: 48px" alt="<?= Yii::$app->name ?>">
                */ ?>
                <span class="icon-emotsmile"></span>
                <?= Yii::$app->name ?>
            </span>
            <?php /*
            <img class="c-sidebar-brand-minimized" src="<?= Yii::getAlias('@web/logo.png') ?>" style="max-height: 48px" alt="<?= Yii::$app->name ?>">
            */ ?>
            <span class="c-sidebar-brand-minimized icon-emotsmile"></span>
        </a>
        <?= Menu::widget([
            'items' => [
                [
                    'url' => Yii::$app->homeUrl,
                    'label' => Yii::t('app', 'Home'),
                ],
            ],
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
                <span class="icon-menu"></span>
            </button>
            <a class="c-header-brand d-lg-none" href="<?= Yii::$app->homeUrl ?>">
                <?php /*
                <img src="<?= Yii::getAlias('@web/logo-wide.png') ?>" alt="<?= Yii::$app->name ?>">
                */ ?>
                <span class="icon-emotsmile"></span>
            </a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                    data-class="c-sidebar-lg-show" responsive="true">
                <span class="icon-menu"></span>
            </button>
            <?= Nav::widget([
                'id' => 'top-menu',
                'encodeLabels' => false,
                'options' => [
                    'class' => 'c-header-nav ml-auto mr-4',
                ],
                'items' => $topMenu,
            ]) ?>
            <?php if (!empty($this->params['breadcrumbs'])) { ?>
                <div class="c-subheader px-3">
                    <?= Breadcrumbs::widget([
                        'options' => ['class' => 'breadcrumb border-0 m-0'],
                        'links' => $this->params['breadcrumbs'],
                        'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                        'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                        'encodeLabels' => false,
                    ])
                    ?>
                </div>
            <?php } ?>
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
                    <a href="<?= Yii::$app->homeUrl ?>"><?= Yii::$app->name ?></a>
                </div>
                <div class="ml-auto">
                    <span>&copy; <?= date('Y') ?> <?= Yii::t('app', 'All rights reserved') ?>.</span>
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