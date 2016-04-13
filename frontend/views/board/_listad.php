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
        <div class="col-md-2">
            <?php
            $image = $model->showImage();
            if ($image)
            {
                echo '<img class="img-rounded" src="'.$image.'"  />';
            }
            $duration = $model->duration();
            ?>
        </div>
        <div class="col-md-6">
            <h4 class="list-group-item-heading"><?=$model->name?> <small><?=$model->idObject->name?></small></h4>
            <p  class="list-group-item-text"><span class="glyphicon glyphicon-map-marker"></span> <?=$model->idTown->name?> <?=$model->address?> </p>
            <p  class="">Цена: <span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span> </p>
            <p  class="list-group-item-text"><span class="glyphicon glyphicon-eye-open"></span> Просмотры <?=$model->looks?>;  <?php if (Yii::$app->user->can('agency')) { ?> Запрос контактов <span class="glyphicon glyphicon-user"></span> <?php echo $model->views;  } ?></p>

        </div>
        <div class=" col-md-4">
            <p class="text-muted list-group-item-text">Опубликовано: <strong><?= Yii::$app->formatter->asDate($model->date_create, "php: d F H:i ") ?></strong> </p>
            <p class="text-muted">Истекает: &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <strong><?= Yii::$app->formatter->asDate($model->date_finish, "php: d F H:i ") ?></strong> </p>

            <p class="text-muted list-group-item-text"><?=$duration['text']?></p>
            <div class="progress">
                <div class="progress-bar <?=$duration['class']?>" role="progressbar" aria-valuenow="<?= $duration['percent']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $duration['percent']?>%">
                </div>
            </div>
        </div>
    </div>
</a>
