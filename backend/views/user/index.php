<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model){
            if ($model->status == User::STATUS_DELETED) {
                return ['class' => 'danger'];
            }
            else {
                if ($model->valid_token)
                    return ['class' => 'info'];
                else
                    return ['class' => ''];
            }
        },

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'fio',
            'phone',
             'email:email',
             'agency',
            [
                'attribute' => 'role',
                'format' => 'html',
                'value' => function($data){
                    $roles = User::getAllRoles();
                    return $roles[$data->role];
                },
                'filter'=>$searchModel->getAllRoleGrid(),

            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} ',
            ],
        ],
    ]); ?>

</div>
