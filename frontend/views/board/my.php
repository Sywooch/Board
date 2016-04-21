<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 19:15
 */

/* @var $this yii\web\View */
/* @var $model common\models\Board */
use \yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Мои объявления';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#"><strong>Активные</strong></a></li>
        <li><?=Html::a('<strong>Завершенные</strong>',  ['ended'] )?></li>
        <?php if (Yii::$app->user->can('agency')) { echo '<li>'.Html::a('<strong>Статистика</strong>',  ['statistic'] ).'</li>'; } ?>
    </ul>

</div>
<br />
<?php
foreach ($models as $model)
{
    ?>
    <div class="row">

        <div class="col-md-10">
            <?php
            echo $this->render('_listad', [
                'model' => $model,
            ]);
            ?>
        </div>
        <div class="col-md-2">
            <?=Html::a('<span class="glyphicon glyphicon-pencil"></span>',  ['update', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data-toggle'=>"tooltip",
                'data-placement'=>"left",
                'title'=>"Редактировать"
            ] )?>
            <br /><br /><br />
            <?=Html::a('<span class="glyphicon glyphicon-remove"></span>',  ['close', 'id' => $model->id], ['class' => 'btn btn-danger',
                'data-toggle'=>"tooltip", 'title'=>"Закрыть",
                'data' => [
                'confirm' => 'Закрыть объявление?',

            ],] )?>
        </div>
    </div>
  <hr />
<?php
}
?>