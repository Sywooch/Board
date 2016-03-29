<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Купить, продать, снять, сдать ';


?>
<div class="site-index">
        <?=$this->render('_search', [
            'model' => $model,
            'properties' => null
        ])?>


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
                if ($left_reklama)
                {
                    foreach ($left_reklama as $model_reklama)
                    {
                        echo $this->render('_reklama', [
                            'model' => $model_reklama->idBoard,
                        ]);
                    }
                }

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
                if ($right_reklama)
                {
                    foreach ($right_reklama as $model_reklama)
                    {
                        echo $this->render('_reklama', [
                            'model' => $model_reklama->idBoard,
                        ]);
                    }
                }

                ?>
            </div>


        </div>

    </div>
</div>
