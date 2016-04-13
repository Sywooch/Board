<?php

/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 13:29
 */

/* @var $model common\models\Board */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои объявления', 'url' => ['my']];
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
        $image = $model->showImage('500x400');
        if ($image)
        {
            echo '<div id="MainImg"><img class="img-rounded" src="'.$image.'" /></div>';
        }

        ?>
    </div>
    <div class="col-md-1">
        <?php
        $images = $model->showImages();
        if ($images)
        {
            foreach ($images as $img)
            {
                $big_img = str_replace(Yii::getAlias('@webroot'), '', $img->getPath('500x400'));
                echo Html::img( str_replace(Yii::getAlias('@webroot'), '', $img->getPath('70x70')), [
                        'class' => 'img-rounded listimg',
                        'onclick' => "loadimg('$big_img')"
                    ]). '';
            }
        }
        //echo var_dump($images = $model->getImages());
        ?>
    </div>
    <div class="col-md-4">


        <?php if ($model->active())
        {
            echo Html::a('<span class="glyphicon glyphicon-pencil"></span> Редактировать объявление',  ['update', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data-toggle'=>"tooltip",
                'data-placement'=>"left",
                'title'=>"Редактировать"
            ] ). '<br /><br />';
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Закрыть объявление',  ['close', 'id' => $model->id], ['class' => 'btn btn-danger',
                'data-toggle'=>"tooltip", 'title'=>"Закрыть",
                'data' => [
                    'confirm' => 'Закрыть объявление?',

                ],] );
        }
        else {
            echo Html::a('<span class="glyphicon glyphicon-repeat" ></span> Опубликовать объявление',  ['public', 'id' => $model->id], [
                'class' => 'btn btn-success', 'data-toggle'=>"tooltip", 'title'=>"Опубликовать",
                'data' => [

                    'confirm' => 'Опубликовать?',

                ],] ). '<br /><br />';

            echo Html::a('<span class="glyphicon glyphicon-remove-circle" ></span> Удалить объявление безвозвратно', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',  'data-toggle'=>"tooltip", 'title'=>"Удалить объявление безвозвратно",
                'data' => [
                    'confirm' => 'Удалить объявление безвозвратно?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
        <hr />
        <?php if (Yii::$app->user->can('agency')) {
            $form = ActiveForm::begin(); ?>
            <h3>Выделить объявление</h3>

            <?= $form->field($model, 'marked')->dropDownList($model->ListMarked()) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php
            ActiveForm::end();
        }
        ?>
    </div>
</div>
<br /><hr />
<div class="row">

    <div class="col-md-6">
        <p class="lead">Цена: <span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span></p>
        <p class="lead"> Продавец: <strong><?=$model->idUser->fio?></strong></p>
        <p> <span class="glyphicon glyphicon-map-marker"></span> <?=$model->idTown->name?> <?=$model->address?> </p>
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
