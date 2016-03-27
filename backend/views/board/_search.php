<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BoardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'id_object') ?>

    <?= $form->field($model, 'id_town') ?>

    <?= $form->field($model, 'id_type') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
