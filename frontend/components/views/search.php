<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 29.03.16
 * Time: 21:29
 */


/* @var $model frontend\models\Search */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$getpropeties_route = Url::toRoute('ajax/getpropeties');
$script = <<< JS
    var input_filed;
    function loadProp(id) {
        id_obj = $("#searchform-id_object").val();
        id_type = $("#searchform-id_type").val();
        if ((id_obj!='')&&(id_type!=''))
        {
        $("#LoadAjax").empty();
             $.get( "$getpropeties_route", { id_object: id_obj, id_type: id_type } )
            .done(function( json )
            {
                data = JSON.parse(json);
                $.each(data, function() {
                    if (this.val != false)
                    {
                        input_filed = '<select class="form-control" name="SearchForm[Properties]['+ this.id +']"><option> - '+this.name+' - </option>';
                        $.each(this.val, function(){
                            input_filed = input_filed + '<option value="'+ this +'">'+this+'</option>';
                        });
                        input_filed = input_filed + '</select>';
                        $("#LoadAjax").append(input_filed);
                    }
                });
            });
        }
        else {
            $("#LoadAjax").empty();
        }
    }

JS;
$this->registerJs($script, yii\web\View::POS_HEAD);

?>
<?php $form = ActiveForm::begin( [
    'action' => ['site/result'],
    'method' => 'GET',
    'options' => [
        'class' => 'form-inline main-search'
    ]
]); ?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h2 class="panel-title text-center">Поиск Недвижимости</h2>
    </div>
    <div class="panel-body">

        <?= $form->field($model, 'id_type')->dropDownList(\common\models\Type::AllTypes(), ['prompt' => '- Тип Объявления -',  'onchange'=>'loadProp($(this).val())'])->label(false) ?>
        <?= $form->field($model, 'id_object')->dropDownList(\common\models\Object::AllObjects(),  ['prompt' => '- Вид Недвижимости -', 'onchange'=>'loadProp($(this).val())'])->label(false) ?>
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Я ищу...'])->label(false) ?>
        <?= $form->field($model, 'id_town')->dropDownList(\common\models\Town::FrAllTowns(), ['prompt' => '- Во всех городах -', ])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Найти!', ['class' => 'btn btn-primary', ]) ?>
            <div class="help-block"></div>
        </div>

    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-9">
                <?php
                /*
                 * @TODO Сделать поиск по параметрам
                 * <div class="col-md-9"  id="LoadAjax">
                if ($model->loadProperties())
                {
                    $string_prop = '';
                    foreach ($model->loadProperties() as $prop)
                    {
                        if ($prop['val'])
                        {
                            $input_filed = '<select class="form-control" name="SearchForm[Properties]['. $prop['id'] .']"><option> - '. $prop['name']. ' - </option>';
                            foreach ($prop['val'] as $value)
                            {
                                $input_filed = $input_filed . '<option value="'. $value .'">'.$value.'</option>';
                            }

                            $input_filed = $input_filed . '</select>';
                            $string_prop = $string_prop . $input_filed;
                        }
                    }

                    echo $string_prop;
                }
                */
                ?>
            </div>
            <div class="col-md-3">
                <label>Цена</label>
                <?= $form->field($model, 'price_min')->widget(\yii\widgets\MaskedInput::className(), [
                    'clientOptions' => [
                        'alias' =>  'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                    ],
                ])->label(false) ?> -
                <?= $form->field($model, 'price_max')->widget(\yii\widgets\MaskedInput::className(), [
                    'clientOptions' => [
                        'alias' =>  'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                    ],
                ])->label(false) ?>
            </div>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
