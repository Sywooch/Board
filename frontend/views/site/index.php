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
                foreach ($last as $model_board)
                {
                    echo $this->render('_smallad', [
                        'model' => $model_board,
                    ]);
                }
                ?>
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
