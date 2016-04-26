<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\password\PasswordInput;



$this->title = 'Регистрация на сайте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста заполните поля ниже для регистрации:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'fio') ?>

                <?= $form->field($model, 'phone', [
                    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">8</span>{input}</div>',
                ])->widget(\yii\widgets\MaskedInput::className(), [
                    'name' => 'phone',
                    'mask' => '999-999-9999',

                ]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->widget(PasswordInput::classname(), [
                    'pluginOptions' => [
                             'showMeter' => false,
                  //      'toggleMask' => false,

                    ]
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
</div>
