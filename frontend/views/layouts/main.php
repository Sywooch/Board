<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <title>Недвижимость Октябрьский. <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/images/gerb.png" />',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Подать объявление', 'url' => ['/board/step']],
        ['label' => 'Информация', 'url' => ['/site/about']],


    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Мои объявления', 'url' => ['/board/my']];
        $menuItems[] = ['label' => Yii::$app->user->identity->fio,  'items' =>
            [
                ['label' => 'Мой кабинет ', 'url' => ['/user/cabinet']],
                ['label' => 'Выйти ', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ]

        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    $css_container = '';
    if (Yii::$app->controller->route=='site/index') {
        ?>
        <div class="top-image">
            <div class="jumbotron">
                <h1>НЕДВИЖИМОСТЬ-ОКТЯБРЬСКИЙ.РФ</h1>


            </div>
        </div>
        <?php
        $css_container = ' main_cont';
    }
    ?>
    <div class="container<?=$css_container?>">
        <?php
        // Вывод виджета поиска
        if (isset($this->params['searchform']))
        {
            echo \app\components\SearchWidget::widget([
                'search' => $this->params['searchform'],

            ]);

        }
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Доска объявлений <?= date('Y') ?></p>

        <p class="pull-right">
            <?php
            if (YII_ENV_PROD)
            {
                ?>
            <!-- Yandex.Metrika informer -->
            <a href="https://metrika.yandex.ru/stat/?id=36406615&amp;from=informer"
               target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/36406615/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                                   style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:36406615,lang:'ru'});return false}catch(e){}" /></a>
            <!-- /Yandex.Metrika informer -->

            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function() {
                        try {
                            w.yaCounter36406615 = new Ya.Metrika({
                                id:36406615,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true,
                                webvisor:true
                            });
                        } catch(e) { }
                    });

                    var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () { n.parentNode.insertBefore(s, n); };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = "https://mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else { f(); }
                })(document, window, "yandex_metrika_callbacks");
            </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/36406615" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
            <?php
            }
            ?>

        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
