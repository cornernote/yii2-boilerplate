<?php
use yii\helpers\Url;

/* @var $this \yii\web\View */
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div id="sidebar" class="sidebar responsive">
        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>
                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>
                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>
                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>
            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>
                <span class="btn btn-info"></span>
                <span class="btn btn-warning"></span>
                <span class="btn btn-danger"></span>
            </div>
        </div>

        <ul class="nav nav-list">
            <li class="">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="<?php echo Yii::$app->controller->id == 'job' ? 'open active' : '' ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-truck"></i>
							<span class="menu-text">
								Jobs
							</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php echo Yii::$app->controller->id == 'job' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/admin/job/index']) ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Jobs
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php echo Yii::$app->controller->id == 'job' && Yii::$app->controller->action->id == 'create' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/admin/job/create']) ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Create Job
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="<?php echo Yii::$app->controller->id == 'package' ? 'open active' : '' ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-dropbox"></i>
							<span class="menu-text">
								Packages
							</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php echo Yii::$app->controller->id == 'package' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/admin/package/index']) ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Packages
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php echo Yii::$app->controller->id == 'package' && Yii::$app->controller->action->id == 'create' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/admin/package/create']) ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Create Package
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

            <li class="<?php echo Yii::$app->controller->id == 'admin' ? 'open active' : '' ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-users"></i>
							<span class="menu-text">
								Users
							</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php echo Yii::$app->controller->id == 'admin' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/user/admin/index']) ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            List Users
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="<?php echo Yii::$app->controller->id == 'admin' && Yii::$app->controller->action->id == 'create' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/user/admin/create']) ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Create User
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>

        </ul>
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
               data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>
<?php endif; ?>
