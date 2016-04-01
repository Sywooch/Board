<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 01.04.16
 * Time: 20:46
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Изменить пароль для: ' . ' ' . $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить пароль';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'old_password')->textInput() ?>

        <?= $form->field($model, 'new_password')->textInput() ?>



        <div class="form-group">
            <?= Html::submitButton('Сохранить новый пароль', ['class' =>  'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
