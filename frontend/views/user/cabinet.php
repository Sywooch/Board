<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 12.03.16
 * Time: 9:46
 */
use yii\web\YiiAsset;
//use frontend\assets\AppAsset;
use yii\bootstrap\Html;

$this->title = 'Мой кабинет';
$this->params['breadcrumbs'][] = $this->title;

/* @var $model common\models\User */

?>
<h1>Мой кабинет</h1>

<p class="lead">Ваше имя: <?=$model->fio?></p>
<p class="lead">Телефон: 8-<?=$model->phone?></p>
<p class="lead">Email: <?=$model->email?>
    <?php
    if ($model->valid_token)
    {
        echo '<span class="label label-danger">Не подтвержден</span> ';
    }
    else
    {
        echo '<span class="label label-success">Подтвержден</span>';
    }
    ?>
     </p>
<?php
if ($model->role==$model::ROLE_AGENCY)
{
    $duration = $model->expireAgency();
    ?>
    <p class="lead">Агентство: <?=$model->agency?></p>
    <p class="lead">Срок истекает <strong><?= Yii::$app->formatter->asDate($model->date_expire, "php: d F H:i ") ?></strong></p>
    <div class="row">
        <div class="col-md-3">
        <p class="lead"><?=$duration['text']?></p>
            <div class="progress">
                <div class="progress-bar <?=$duration['class']?>" role="progressbar" aria-valuenow="<?= $duration['percent']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $duration['percent']?>%">
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<p>
    <?= Html::a('Изменить данные', ['user/update'], ['class' => 'btn btn-info']) ?>

</p>
