<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 02.03.16
 * Time: 22:23
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$script = <<< JS


    $('input[name="id_type"]').change(function(){
        $('#panel_obj').show();
    });

    $('input[name="id_object"]').change(function(){
        $('#panel_btn').show();
    })


JS;
$this->registerJs($script, yii\web\View::POS_READY);

$this->title = 'Подать объявление. Шаг 1';
$this->params['breadcrumbs'][] = $this->title;

?>

<h2><?=$this->title?></h2>
<?php $form = ActiveForm::begin(['id' => 'login-form',  'action' => ['board/create'],]); ?>



<div class="row">
    <div class="col-md-4">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Тип Объявления</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                <?php
                foreach ($type as $tp)
                {
                    echo '<li class="list-group-item"><label class="btn btn-lg btn-warning btn-block"><input type="radio" name="id_type" value="'. $tp->id .'"> '. $tp->name .'</label></li>';
                }
                ?>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="panel panel-info" style="display: none" id="panel_obj">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Тип Недвижимость</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                <?php
                foreach ($object as $obj)
                {
                    echo '<li class="list-group-item"><label class="btn btn-lg btn-info btn-block"><input type="radio" name="id_object" value="'. $obj->id .'"> '. $obj->name .'</label></li>';
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-success"  style="display: none" id="panel_btn">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Далее</h3>
            </div>
            <div class="panel-body">
                <?= Html::submitButton('Далее', ['class' => 'btn btn-success btn-lg btn-block', 'name' => 'signup-button']) ?>
            </div>
        </div>


    </div>
</div>
<?php ActiveForm::end(); ?>