<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?= Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="application">
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav mr-auto'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/']],
                    ['label' => 'Categories', 'url' => ['/category']],
                    ['label' => 'Jobs', 'url' => ['/job']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav '],
                'items' => [
                    Yii::$app->user->isGuest
                        ? ['label' => 'Login', 'url' => ['/user/login']]
                        : ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/user/logout']],
                    yii::$app->user->isGuest
                        ? ['label' => 'Register', 'url' => ['/user/register']]
                        : '',
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?= Breadcrumbs::widget([
                    'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
                    'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>

                <div class="w-75 mx-auto">
                    <?= $content ?>
                </div>
            </div>
        </div>

        <footer class="footer pt-3 bg-dark text-white">
            <div class="container w-100 d-flex justify-content-between">
                <p>&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

                <p>
                    Github repository link <a href="https://github.com/Botche/job-offers">here</a>
                </p>
            </div>
        </footer>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>