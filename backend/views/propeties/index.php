<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PropetiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Свойтсва';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="propeties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать свойство', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'idType',
                'value' => 'idType.name',
                'filter'=>$searchModel->getAllTypeGrid(),
                'contentOptions' => ['style'=>'width:150px',]
            ],
            [
                'attribute' => 'idObject',
                'value' => 'idObject.name',
                'filter'=>$searchModel->getAllObjectGrid(),
                'contentOptions' => ['style'=>'width:200px',]
            ],
            'name',
            'val',

            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} ',
            ],
        ],
    ]); ?>

</div>
