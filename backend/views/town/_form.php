<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Town */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="town-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_region')->dropDownList(\common\models\Region::AllRegions(),  ['prompt'=>'-Выберите Регион-']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'default')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
