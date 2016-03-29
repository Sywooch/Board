<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Board */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS



    function loadimg(idimg)
    {
        $("#MainImg").empty();
        $("#MainImg").html('<img class="img-rounded" src="'+idimg+'" />');
    }



JS;
$this->registerJs($script, yii\web\View::POS_END);
?>

<h2 class=""><?=$model->name?></h2>
<div class="row">
    <div class="col-md-6">
        <?php
        $image = $model->getImage();
        if ($image)

            echo '<div id="MainImg"><img class="img-rounded" src="'.Yii::$app->params['front_url'].str_replace(Yii::getAlias('@frontend').'/web', '', $image->getPath('500x400')).'" /></div>';
        ?>
    </div>
    <div class="col-md-1">
        <?php
        $images = $model->getImages();
        if ($images)
        {
            foreach ($images as $img)
            {
                //echo $img->urlAlias;
                $big_img = Yii::$app->params['front_url'].str_replace(Yii::getAlias('@frontend').'/web', '', $img->getPath('500x400'));
                echo Html::img(Yii::$app->params['front_url'].str_replace(Yii::getAlias('@frontend').'/web', '', $img->getPath('70x70')), [
                        'class' => 'img-rounded listimg',
                        'onclick' => "loadimg('$big_img')"
                    ]). '';
            }
        }
        //echo var_dump($images = $model->getImages());
        ?>
    </div>
    <div class="col-md-3">
        <?= Html::a('Сделать рекламным', ['reklama/create', 'id' => $model->id], [
            'class' => 'btn btn-success',
           ]) ?>
        <br />
        <?php $form = ActiveForm::begin(); ?>



        <?= $form->field($model, 'enable')->radioList($model->AllStatus()) ?>

        <?= $form->field($model, 'marked')->dropDownList($model->ListMarked()) ?>

        <div class="form-group">
            <?= Html::submitButton( 'Сохранить изменения', ['class' =>  'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <hr />
        <?= Html::a('Удалить объявление', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
<br /><hr />
<div class="row">

    <div class="col-md-6">
        <p class="lead">Цена: <span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span></p>
        <p class="lead"> Продавец: <strong><?=$model->idUser->fio?></strong> <a href="<?=Url::toRoute(['user/view', 'id' => $model->id_user])?>" class="btn btn-default"> <span class="glyphicon glyphicon-cog"></span></a> </p>
        <p class="lead"> Контакты: <span class="label label-info">8-<?=$model->idUser->phone?></span> <span class="label label-warning"><?=$model->idUser->email?></span>
            </p>
        <hr />
        <p><?=nl2br(Html::encode($model->text))?></p>
        <table class="table table-striped table-condensed">
            <?php
            foreach ($model->idAttributes as $attr)
            {
                if ($attr->idProperty) $pname = $attr->idProperty->name; else $pname = '';
                echo '<tr>
                    <td>'.  $pname .'</td>
                    <td><strong>'. $attr->value .'</strong></td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</div>
