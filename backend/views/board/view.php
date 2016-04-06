<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\models\Reklama;

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
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-8">
                <?php
                $image = $model->getImage();
                if (file_exists(Yii::getAlias('@frontend').'/web/uploadimg/store/'.$image->filePath))

                    echo '<div id="MainImg"><img class="img-rounded" src="'.Yii::$app->params['front_url'].str_replace(Yii::getAlias('@frontend').'/web', '', $image->getPath('500x400')).'" /></div>';
                ?>
            </div>
            <div class="col-md-4">
                <?php
                $images = $model->getImages();
                if ($images)
                {
                    foreach ($images as $img)
                    {
                        if (file_exists(Yii::getAlias('@frontend').'/web/uploadimg/store/'.$image->filePath))
                        {
                            $big_img = Yii::$app->params['front_url'].str_replace(Yii::getAlias('@frontend').'/web', '', $img->getPath('500x400'));
                            echo Html::img(Yii::$app->params['front_url'].str_replace(Yii::getAlias('@frontend').'/web', '', $img->getPath('70x70')), [
                                    'class' => 'img-rounded listimg',
                                    'onclick' => "loadimg('$big_img')"
                                ]). '';
                        }

                    }
                }
                //echo var_dump($images = $model->getImages());
                ?>
            </div>

        </div>
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
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Рекламные блоки</h3>
            </div>
            <div class="panel-body">
                <?php
                if ($model->idReklamas)
                {
                    echo '<ul  class="list-group">';
                    foreach ($model->idReklamas as $reklama)
                    {
                        $page = Reklama::ListPages();
                        $position = Reklama::ListPositions();
                        echo '<li  class="list-group-item"><strong>'. $page[$reklama->page] .'</strong> - '. $position[$reklama->position] .
                            ' '.Html::a('<span class="glyphicon glyphicon-remove"></span> ', ['reklama/delete', 'id' => $reklama->id], [
                                'class' => 'btn btn-default btn-small',
                                'title' => 'Удалить',
                                'data' => [
                                    'confirm' => 'Удалить из блока?',
                                    'method' => 'post',
                                ],
                            ]), '</li>';
                    }
                    echo  '</ul>';
                }
                ?>
                <?= Html::a('Сделать рекламным', ['reklama/create', 'id' => $model->id], [
                    'class' => 'btn btn-success btn-block',
                ]) ?>
            </div>
        </div>

        <br />
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Параметры объявление</h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>



                <?= $form->field($model, 'enable')->radioList($model->AllStatus()) ?>

                <?= $form->field($model, 'marked')->dropDownList($model->ListMarked()) ?>

                <div class="form-group">
                    <?= Html::submitButton( 'Сохранить изменения', ['class' =>  'btn btn-primary btn-block']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>


        <?= Html::a('Удалить объявление', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>

    </div>


</div>

