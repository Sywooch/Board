<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reklama */

$this->title = 'Изменить Рекламный блок для : ' . $model->idBoard->name;
$this->params['breadcrumbs'][] = ['label' => 'Реклама', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Изменить '. $this->title;
?>
<div class="reklama-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
