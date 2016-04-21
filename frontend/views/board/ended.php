<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 17.03.16
 * Time: 15:38
 */
use yii\helpers\Html;
$this->title = 'Мои объявления';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="row">
        <ul class="nav nav-tabs">
            <li><?=Html::a(' <strong>Активные</strong>',  ['my'] )?></li>
            <li class="active"><a href="#"><strong>Завершенные</strong></a></li>
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

            <br />
            <?=Html::a('<span class="glyphicon glyphicon-repeat" ></span>',  ['public', 'id' => $model->id], [
                'class' => 'btn btn-success', 'data-toggle'=>"tooltip", 'title'=>"Опубликовать",
                'data' => [

                    'confirm' => 'Опубликовать?',

                ],] )?>
            <br /><br />
            <?= Html::a('<span class="glyphicon glyphicon-remove-circle" ></span>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',  'data-toggle'=>"tooltip", 'title'=>"Удалить объявление безвозвратно",
                'data' => [
                    'confirm' => 'Удалить объявление безвозвратно?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <hr />
    <?php
}
?>