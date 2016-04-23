<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Изменить пользователя: ' . ' ' . $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'fio')->textInput() ?>

        <?= $form->field($model, 'agency')->textInput() ?>

        <?= $form->field($model, 'role')->dropDownList($model->getAllRoles()) ?>
        <div class="form-group">
            <label class="control-label"><?=$model->getAttributeLabel('date_expire')?></label>
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'date_expire',
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => [
                    'class' => 'form-control',
                ]

            ]);
            ?>
            <div class="help-block">
                Кнопка ПРОДЛИТЬ будет проделвать подписку на месяц на тоже самое число
            </div>
        </div>


        <?= $form->field($model, 'status')->radioList($model->AllStatus()) ?>



        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' =>  'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
