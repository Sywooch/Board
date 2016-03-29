<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reklama */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reklama-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'page')->dropDownList($model->ListPages()) ?>

    <?= $form->field($model, 'position')->dropDownList($model->ListPositions()) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
