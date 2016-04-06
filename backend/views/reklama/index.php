<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Reklama;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReklamaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рекламные объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reklama-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'idBoard',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        $data->idBoard->name,
                       ['board/view', 'id'=> $data->id_board],
                        [
                            'title' => 'Перейти в объявление',
                        ]
                    );
                }

            ],

            [
                'attribute' => 'page',
                'format' => 'html',
                'value' => function($data){
                    $page = Reklama::ListPages();
                    return $page[$data->page];
                },
                'filter'=>$searchModel->getAllPageGrid(),

            ],
            [
                'attribute' => 'position',
                'format' => 'html',
                'value' => function($data){
                    $page = Reklama::ListPositions();
                    return $page[$data->position];
                },
                 'filter'=>$searchModel->getAllPositionGrid(),

            ],
            'weight',

            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
                'template' => '{update} - {delete}',
            ],
        ],
    ]); ?>
</div>
