<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\bootstrap\Nav;
use app\models\Operation;
use yii\helpers\Html;
use app\assets\DashboardAsset;


DashboardAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
                <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-leaf"></i></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <?php if(Yii::$app->user->getIdentity()->is_admin):?>
                    <li>
                        <a href=""> <i class="glyphicon glyphicon-shopping-cart"></i> <?= \Yii::t('app', 'In cash:')?> <?php echo number_format(Operation::getCashAmount(), 2) ?>$</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href=""> <i class="glyphicon glyphicon-usd"></i> <?= \Yii::t('app', 'Balance:')?> <?php echo number_format(\Yii::$app->getUser()->identity->balance, 2) ?>$</a>
                    </li>
                <?php endif; ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?= \Yii::$app->user->getIdentity()->login ?><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                        <?php
                            echo Html::beginForm(['/login/logout'], 'post')
                            . Html::submitButton(
                                '<i class="glyphicon glyphicon-off"></i> ' . Yii::t('app', "Logout"),
                                ['class' => 'btn btn-link logout', 'style' => 'color:#444']
                            )
                            . Html::endForm()
                        ?>
                        </li>
                    </ul>
                </li>
            </ul>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <?php if(Yii::$app->user->getIdentity()->is_admin):?>
                <?php
                echo Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => [
                        ['label' => \Yii::t('app', 'Reports'), 'url' => ['/admin/index']],
                        ['label' => \Yii::t('app', 'Operations'), 'url' => ['/admin/operations']],
                        ['label' => '<i class="glyphicon glyphicon-shopping-cart"></i> ' . \Yii::t('app', 'Cash Entry/Withdrawal'), 'url' => ['/admin/withdrawals'], 'encode' => false],
                        ['label' => '<i class="glyphicon glyphicon-user"></i> ' . \Yii::t('app', 'Person Entry/Withdrawal'), 'url' => ['/admin/person-withdrawals'], 'encode' => false],
                    ]
                ]);
                ?>
            <?php else: ?>
                <?php
                echo Nav::widget([
                    'options' => ['class' => 'nav nav-sidebar'],
                    'items' => [
                        ['label' => \Yii::t('app', 'Reports'), 'url' => ['/user/index']],
                        ['label' => \Yii::t('app', 'Operations'), 'url' => ['/user/operations']],
                        ['label' => \Yii::t('app', 'New report'), 'url' => ['/user/new-report']]
                    ]
                ]);
                ?>
            <?php endif;?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php if(\Yii::$app->session->hasFlash('success')):?>
                <div class="alert alert-success" role="alert" alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    <?= \Yii::$app->session->getFlash('success')?>
                </div>
            <?php elseif(\Yii::$app->session->hasFlash('danger')):?>
                <div class="alert alert-danger" role="alert" alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    <?= \Yii::$app->session->getFlash('danger')?>
                </div>
            <?php endif?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
