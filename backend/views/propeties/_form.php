<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Propeties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propeties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_object')->dropDownList(\common\models\Object::AllObjects(), ['prompt' => '- Выберите объект -']) ?>

    <?= $form->field($model, 'id_type')->dropDownList(\common\models\Type::AllTypes(), ['prompt' => '- Выберите Тип -']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'val')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
