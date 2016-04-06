<?php

/* @var $this yii\web\View */


use yii\helpers\Html;


$this->title = 'Купить, продать, снять, сдать ';

use app\components\ReklamaWidget;
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?= Html::a('Подать объявление', ['board/step'], ['class' => 'btn btn-success btn-lg btn-block']) ?>
            </div>
        </div>
        <br /><br />
        <div class="row">
            <div class="col-md-2">
                <?php
                echo ReklamaWidget::widget([
                    'position' => \common\models\Reklama::POS_LEFT,
                    'page' => \common\models\Reklama::PAGE_INDEX,

                ]);

                ?>
            </div>
            <div class="col-md-8">
                <?php
#/*
                foreach ($last as $model_board)
                {
                    echo $this->render('_smallad', [
                        'model' => $model_board,
                    ]);
                }
#*/
                ?>
                <div class="center-block text-center">
                    <ul class="pagination">

                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <?php
                        for ($i=2; $i<17; $i++)
                        {
                            echo '<li>'. Html::a($i, [
                                    'result',
                                    'Search[id_type]',
                                    'Search[id_object]',
                                    'Search[name]',
                                    'Search[id_town]',
                                    'Search[price_min]',
                                    'Search[price_max]',
                                    'page'=> $i,
                                    'per-page' =>10]);
                        }
                        ?>

                        <li><?= Html::a('Все объявления &raquo;', [
                                'result',
                                'Search[id_type]',
                                'Search[id_object]',
                                'Search[name]',
                                'Search[id_town]',
                                'Search[price_min]',
                                'Search[price_max]',
                                ])?></li>

                    </ul>
                </div>


            </div>
            <div class="col-md-2">
                <?php
                echo ReklamaWidget::widget([
                    'position' => \common\models\Reklama::POS_RIGHT,
                    'page' => \common\models\Reklama::PAGE_INDEX,
                    'random' => true,
                ]);

                ?>
            </div>


        </div>

    </div>
</div>
