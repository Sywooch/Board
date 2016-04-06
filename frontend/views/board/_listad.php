<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 27.03.16
 * Time: 10:18
 */

/* @var $model common\models\Board */

use yii\helpers\Url;
?>

<a href="<?= Url::toRoute(['board/viewmy', 'id' => $model->id])?>" class="list-group-item marked_<?=$model->marked?>">
    <div class="media">
        <p class="pull-left">
            <?php
            $image = $model->getImage();

            if (file_exists(Yii::getAlias('@webroot').'/uploadimg/store/'.$image->filePath))
            {

                    echo '<img class="img-rounded" src="'.str_replace(Yii::getAlias('@webroot'), '', $image->getPath('100x100')).'"  />';
            }

            ?>
        </p>
        <div class="media-body">
            <h4 class="list-group-item-heading"><?=$model->name?> <small><?=$model->idObject->name?></small></h4>
            <p  class="list-group-item-text"><span class="glyphicon glyphicon-map-marker"></span> <?=$model->idTown->name?> <?=$model->address?> </p>

            <p class="list-group-item-text">Цена: <span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span> </p>
            <p  class="list-group-item-text"><span class="glyphicon glyphicon-eye-open"></span> Просмотры <?=$model->looks?>;  <?php if (Yii::$app->user->can('agency')) { ?> Запрос контактов <span class="glyphicon glyphicon-user"></span> <?php echo $model->views;  } ?></p>
            <p class="text-muted pull-right">Опубликовано: <strong><?= Yii::$app->formatter->asDate($model->date_create, "php: d M H:i ") ?></strong> </p>
        </div>
    </div>
</a>
