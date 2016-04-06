<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model){
            if ($model->Active()) {
                if ($model->idReklamas)
                    return ['class' => 'warning'];

            }
            else {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'value' => 'id',

                'contentOptions' => ['style'=>'width:80px',]

            ],
            [
                'attribute' => 'date_create',
                'value' => 'date_create',
                'format' => ['date', 'php:d M H:i'],
                'contentOptions' => ['style'=>'width:130px',]

            ],
            [
                'attribute' => 'idUser',
                'value' => 'idUser.fio',
            ],
            [
                'attribute' => 'idTown',
                'value' => 'idTown.name',
                'filter' => $searchModel->getAllTownGrid(),
            ],
            [
                'attribute' => 'idObject',
                'value' => 'idObject.name',
                'filter'=>$searchModel->getAllObjectGrid(),
            ],

            [
                'attribute' => 'idType',
                'value' => 'idType.name',
                'filter'=>$searchModel->getAllTypeGrid(),
                'contentOptions' => ['style'=>'width:100px',]
            ],
             'name',
            // 'text:ntext',
            // 'address',
             'looks',
             'views',
            // 'enable',

            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '40'],
                'template' => '{view}',
            ],
        ],
    ]); ?>

</div>
