<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 29.03.16
 * Time: 17:19
 */

use yii\helpers\Url;

foreach ($models as $mod)
{
    $model = $mod->idBoard;
    if ($model)
    {
        ?>

        <a href="<?= Url::toRoute(['board/view', 'id' => $model->id])?>" class="list-group-item">
            <div class="media">

                <div class="media-body">
                    <h3 class="text-center"><?=$model->idType->name?> </h3>
                    <h3 class="text-center"><small><?=$model->idObject->name?></small></h3>
                    <p  class="list-group-item-text"><?=$model->name?> </p>
                    <?php
                    $image = $model->getImage();
                    if ($image)

                        echo '<img class="img-rounded" src="'.str_replace(Yii::getAlias('@webroot'), '', $image->getPath('130x130')).'"  />';
                    ?>

                    <p class="small"><span class="glyphicon glyphicon-map-marker"></span> <?=$model->idTown->name?>  </p>
                    <p><?=$model->address?></p>

                    <h4 class="text-center"><span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span> </h4>

                </div>
            </div>
        </a>
        <br />
        <?php
    }

}
?>

