<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 20.03.16
 * Time: 18:27
 *
 * @var string $button_name
 * @var string $button_style
 * @var object $model
 * @var string $heading
 *
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<!-- Button trigger modal -->
<button class="<?=$button_style?>" data-toggle="modal" data-target="#mailModal">
    <?=$button_name?>
</button>

<!-- Modal -->
<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title text-center" id="myModalLabel"><?=$heading?></h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'mail-form',  'action' => $action,]); ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'message')->textarea(['maxlength' => true]) ?>
                <?= $form->field($model, 'uid')->hiddenInput(['value'=> $uid])->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton( 'Отправить',  ['class' =>  'btn btn-success btn-lg' ]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
