<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 05.03.16
 * Time: 17:09
 */

/* @var $model common\models\Board */

use yii\helpers\Url;

//echo var_dump($model);
#/*
?>

<a href="<?= Url::toRoute(['board/view', 'id' => $model->id])?>" class="list-group-item  marked_<?=$model->marked?>">
    <div class="media">
        <p class="pull-left">
            <?php
            $image = $model->getImage();
            if ($image)

                echo '<img class="img-rounded" src="'.str_replace(Yii::getAlias('@webroot'), '', $image->getPath('100x100')).'"  />';
            ?>
        </p>
        <div class="media-body">
            <h4 class="list-group-item-heading"><?=$model->name?> <small><?=$model->idObject->name?></small></h4>
            <p  class="list-group-item-text"><span class="glyphicon glyphicon-map-marker"></span> <?=$model->idTown->name?> <?=$model->address?> </p>
            <br />
            <p class="list-group-item-text">Цена: <span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span> </p>
            <p class="text-muted pull-right">Опубликовано: <strong><?= Yii::$app->formatter->asDate($model->date_create, "php: d M H:i ") ?></strong> </p>
        </div>
    </div>
</a>
<br />
