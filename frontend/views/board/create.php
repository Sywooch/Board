<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 10:23
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Board */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Подать объявление. Шаг 2';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="board-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'layout' => 'horizontal']); ?>
    <?= $form->field($model, 'id_type')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'id_object')->hiddenInput()->label(false) ?>



    <div class="row">
        <div class="col-md-10">
            <?= $form->field($model, 'id_town')->dropDownList(\common\models\Town::FrAllTowns(), ['prompt' => '- Выберите город -']) ?>
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'price')->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' => [
                    'alias' =>  'decimal',
                    'groupSeparator' => ' ',
                    'autoGroup' => true,
                ],
            ]) ?>
        </div>
        <div class="col-md-2">
            <p class="lead">  <strong><?=$model->idType->name?></strong></p>
            <p class="lead">  <strong><?=$model->idObject->name?></strong></p>
        </div>

    </div>
    <div class="row">

        <div class="col-md-10">
        <?php
        foreach ($model->LoadProperty() as $prop)
        {
            if ($prop['val'])
            {
                $input = '<select  class="form-control" name="Board[property]['. $prop['id'] .']">';
                foreach ($prop['val'] as $value)
                {
                    $input = $input. '<option>'. $value .'</option>';
                }
                $input = $input. '</select>';
            }
            else
            {
                $input = '<input class="form-control" type="text" name="Board[property]['. $prop['id'] .']" />';
            }
            ?>
            <div class="form-group field-prop- required">
                <label class="control-label col-sm-3" for="prop-"><?=$prop['name']?></label>
                <div class="col-sm-6">
                    <?=$input?>
                </div>
            </div>
            <?php

        }
        ?>
        </div>
    </div>

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Фотографии <strong>Первое изображение будет главным</strong></h3>
        </div>
        <div class="panel-body">

                <?php
                echo $form->field($model, 'image1')->widget(FileInput::classname(), [
                    //'name' =>
                    'language' => 'ru',
                    'options' => ['accept' => 'image/*',  ],
                    'pluginOptions' => [
                        'showPreview' => true,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false,

                    ]
                ])->label(false);

            echo $form->field($model, 'image2')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,

                ]
            ])->label(false);
            echo $form->field($model, 'image3')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,

                ]
            ])->label(false);
            echo $form->field($model, 'image4')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,

                ]
            ])->label(false);
            echo $form->field($model, 'image5')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false,

                ]
            ])->label(false);
            ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton( 'Создать объявление',  ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

