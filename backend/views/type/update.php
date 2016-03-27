<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Type */

$this->title = 'Изменить тип: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы объявлений', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<p><span class="label-bg label label-danger">Допускаются только правки названий и сортировки!</span> </p>
<div class="type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
