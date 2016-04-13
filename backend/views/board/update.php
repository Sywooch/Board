<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Board */

$this->title = 'Настройки объявления: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="board-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'layout' => 'horizontal']); ?>




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
            <?php
            echo $form->field($model, 'delimg1')->hiddenInput(['value'=>0])->label(false);
            echo $form->field($model, 'delimg2')->hiddenInput(['value'=>0])->label(false);
            echo $form->field($model, 'delimg3')->hiddenInput(['value'=>0])->label(false);
            echo $form->field($model, 'delimg4')->hiddenInput(['value'=>0])->label(false);
            echo $form->field($model, 'delimg5')->hiddenInput(['value'=>0])->label(false);
            ?>
        </div>

    </div>
    <div class="row">

        <div class="col-md-10">

            <?php

            $attribute = ArrayHelper::map($model->idAttributes,'id_prop','value');
            //  echo var_dump($attribute).'</pre>';
            foreach ($model->LoadProperty() as $prop)
            {
                // echo $prop['id'];
                if ($prop['val'])
                {
                    $input = '<select  class="form-control" name="Board[property]['. $prop['id'] .']">';
                    foreach ($prop['val'] as $value)
                    {
                        if (isset($attribute[$prop['id']]))
                        {
                            if (trim($value)==trim($attribute[$prop['id']]))  $selected = 'selected'; else $selected = '';
                            $input = $input. '<option '. $selected .'>'. trim($value) .'</option>';
                        }
                        else {
                            $input = $input. '<option>'. trim($value) .'</option>';
                        }

                    }
                    $input = $input. '</select>';
                }
                else
                {
                    if (isset($attribute[$prop['id']]))
                        $input = '<input class="form-control" type="text" name="Board[property]['. $prop['id'] .']" value="'. trim($attribute[$prop['id']]) .'" />';
                    else
                        $input = '<input class="form-control" type="text" name="Board[property]['. $prop['id'] .']"  />';
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

            $image[1] = [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
            ];
            $image[2] =  [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
            ];
            $image[3] =  [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
            ];
            $image[4] =  [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
            ];
            $image[5] =  [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
            ];
            $images = $model->showImages();
            if ($images) {
                $i = 1;
                foreach ($images as $img)
                {
                    $image[$i] = [
                        'showPreview' => true,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false,
                        'initialPreview'=>[
                            Html::img(str_replace(Yii::getAlias('@webroot'), '', $img->getPath('100x100')), ['class'=>'file-preview-image'])
                        ]];
                    $i++;
                }
            }

            echo $form->field($model, 'image1')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => $image[1],
                'pluginEvents' => [
                    'change' => 'function() { $("#board-delimg1").val(1); console.log(-1); return true;  }',
                    'filecleared' => 'function() { $("#board-delimg1").val(1); console.log(1); return true; }',
                ]
            ])->label(false);

            echo $form->field($model, 'image2')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => $image[2],
                'pluginEvents' => [
                    'change' => 'function() { $("#board-delimg2").val(1); console.log(-2); return true;  }',
                    'filecleared' => 'function() { $("#board-delimg2").val(1); console.log(2); return true; }',
                ]
            ])->label(false);

            echo $form->field($model, 'image3')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => $image[3],
                'pluginEvents' => [
                    'change' => 'function() { $("#board-delimg3").val(1); console.log(-2); return true;  }',
                    'filecleared' => 'function() { $("#board-delimg3").val(1); console.log(3); return true; }',
                ]

            ])->label(false);
            echo $form->field($model, 'image4')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => $image[4],
                'pluginEvents' => [
                    'change' => 'function() { $("#board-delimg4").val(1); console.log(-2); return true;  }',
                    'filecleared' => 'function() { $("#board-delimg4").val(1); console.log(4); return true; }',
                ]])->label(false);
            echo $form->field($model, 'image5')->widget(FileInput::classname(), [
                //'name' =>
                'language' => 'ru',
                'options' => ['accept' => 'image/*',  ],
                'pluginOptions' => $image[5],
                'pluginEvents' => [
                    'change' => 'function() { $("#board-delimg5").val(1); console.log(-2); return true;  }',
                    'filecleared' => 'function() { $("#board-delimg5").val(1); console.log(5); return true; }',
                ]
            ])->label(false);
            #**/
            ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton( 'Сохранить изменения', ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


