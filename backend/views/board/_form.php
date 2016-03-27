<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Board */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js', ['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile("//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css");
$getpropeties_route = Url::toRoute('ajax/getpropeties');
$script = <<< JS
    var input_filed;
    function loadProp(id) {
        $.get( "$getpropeties_route", { id: id } )
            .done(function( json )
            {
                data = JSON.parse(json);
                $.each(data, function() {
                    if (this.val == false)
                    {
                        input_filed = '<input type="text" class="form-control" />'
                    }
                    else
                    {
                        input_filed = '<select>';
                        $.each(this.val, function(){
                            input_filed = input_filed + '<option>'+this+'</option>';
                        });
                        input_filed = input_filed + '</select>';
                    }
                    $("#LoadAjax").append('<li><label class="control-label">'+ this.name+ '</label>' + input_filed+ '</li>');
                });
            });
    }


JS;
$this->registerJs($script, yii\web\View::POS_HEAD);
?>

<div class="board-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'id_town')->dropDownList(\common\models\Town::AllTowns(), ['prompt' => '- Выберите город -']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'id_type')->dropDownList(\common\models\Type::AllTypes(), ['prompt' => '- Выберите тип -']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'id_object')->dropDownList(\common\models\Object::AllObjects(), ['prompt' => '- Выберите объект -',
                'onchange'=>'loadProp($(this).val())']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Свойства</h3>
                </div>
                <div class="panel-body">
                    <ul  id="LoadAjax">

                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Фотографии</h3>
        </div>
        <div class="panel-body">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">Выбрать изображение</span>
                        <span class="fileinput-exists">Изменить</span>
                        <?= Html::activeFileInput($model, 'image', ["accept"=>"image/*" ]) ?>
                    </span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Удалить</a>
                </div>
            </div>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
