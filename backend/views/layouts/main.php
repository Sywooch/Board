<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Доска объявлений',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Объявления', 'url' => ['/board/index']],
        ['label' => 'Пользователи', 'url' => ['/user/index']],
        ['label' => 'Настройки', 'url' => '#', 'items'=> [

            ['label' => 'Свойства', 'url' => ['/propeties/index']],
            ['label' => 'Объект', 'url' => ['/object/index']],
            ['label' => 'Тип', 'url' => ['/type/index']],
            ['label' => 'Местонахождения'],
            ['label' => 'Регионы', 'url' => ['/region/index']],
            ['label' => 'Города', 'url' => ['/town/index']],
            ['label' => 'Контент'],
            ['label' => 'Тексты', 'url' => ['/content/index']],
        ]],
        ['label' => 'Выйти (' . Yii::$app->user->identity->fio . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']]
    ];

    }
    else
    {
        $menuItems = [
            ['label' => 'Войти', 'url' => ['/site/login']],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>

        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="container">

        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
