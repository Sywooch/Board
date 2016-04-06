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
    <p class="text-muted">Если свойство должно быть числом, например (площадь помещения) оставляем это поле пустым</p>
    <p class="text-muted">Если свойство должно быть списком, например (количество комнат) Заполняем через запятую. к примеру: 1, 2, 3
        <span class="label label-warning">В конце запятую не ставить!</span></p>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
