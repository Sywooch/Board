<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                <?= Html::a('Изменить пароль', ['change', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

            </p>
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                <tr>
                    <th><?=$model->getAttributeLabel('fio')?></th>
                    <td><?=$model->fio?></td>
                </tr>
                <tr>
                    <th><?=$model->getAttributeLabel('phone')?></th>
                    <td><?=$model->phone?></td>
                </tr>
                <tr>
                    <th><?=$model->getAttributeLabel('email')?></th>
                    <td><?=$model->email?></td>
                </tr>
                <tr>
                    <th><?=$model->getAttributeLabel('status')?></th>
                    <td><?=$model->status?></td>
                </tr>
                <tr>
                    <th><?=$model->getAttributeLabel('agency')?></th>
                    <td><?=$model->agency?></td>
                </tr>
                <tr>
                    <th><?=$model->getAttributeLabel('role')?></th>
                    <td><?=$model->role?></td>
                </tr>
                <tr>
                    <th><?=$model->getAttributeLabel('billing')?></th>
                    <td><?=$model->billing?> рублей</td>
                </tr>
                <?php if ($model->role==$model::ROLE_AGENCY)
                {
                    ?>
                    <tr>
                        <th><?=$model->getAttributeLabel('date_expire')?></th>
                        <td><?php echo Yii::$app->formatter->asDate($model->date_expire, "php: d F");
                            //if ($model->expireDayAgency()<8) echo 'Продлить';
                            ?></td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(['layout'=>'inline']); ?>

            <?= $form->field($model, 'money_info')->textInput(['placeholder' => $model->getAttributeLabel('money_info')])->label(false) ?>

            <?= $form->field($model, 'money_value')->textInput(['placeholder' => $model->getAttributeLabel('money_value')])->label(false) ?>

            <?= Html::submitButton('Подарить денег', ['class' =>  'btn btn-success']) ?>

            <?php ActiveForm::end(); ?>
            <hr />

            <?= GridView::widget([
                'dataProvider' => $moneyProvider,
                'filterModel' => $searchMoney,


                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'date',
                        'value' => 'date',
                        'format' => ['date', 'php:d M H:i'],
                        'contentOptions' => ['style'=>'width:130px',]

                    ],
                    'info',
                    'value',

                ],
            ]); ?>

        </div>
    </div>




</div>
