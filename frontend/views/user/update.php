<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Изменить пользователя ';
$this->params['breadcrumbs'][] = ['label' => 'Мой кабинет', 'url' => ['cabinet']];

$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fio')->textInput() ?>

        <?= $form->field($model, 'phone', [
            'inputTemplate' => '<div class="input-group"><span class="input-group-addon">8</span>{input}</div>',
        ])->widget(\yii\widgets\MaskedInput::className(), [
            'name' => 'phone',
            'mask' => '999-999-9999',

        ]) ?>


        <?= $form->field($model, 'email')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' =>  'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
