<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 31.03.16
 * Time: 19:52
 */


use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <ul class="nav nav-tabs">
        <li><?=Html::a('Мои объявления - <strong>Активные</strong>',  ['my'] )?></li>
        <li><?=Html::a('Мои объявления - <strong>Завершенные</strong>',  ['ended'] )?></li>
        <li class="active"><a href="#">Мои объявления - <strong>Статистика</strong></a></li>

    </ul>

</div>
<div class="board-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model){
            if ($model->Active()) {
                return ['class' => ''];
            }
            else {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'date_create',
                'value' => 'date_create',
                'format' => ['date', 'php:d M H:i'],
                'contentOptions' => ['style'=>'width:130px',]

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
                'headerOptions' => ['width' => '80'],
                'template' => '{viewmy} - {update} ',
                'buttons' => [
                    'viewmy' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open "></span>',
                            $url);
                    },

                ],
            ],
        ],
    ]); ?>

</div>

