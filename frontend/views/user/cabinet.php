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
if ($model->agency)
{
    echo '<p class="lead">Агентство: '. $model->agency .'</p>';
}
?>

<p>
    <?= Html::a('Изменить данные', ['user/update'], ['class' => 'btn btn-info']) ?>

</p>
