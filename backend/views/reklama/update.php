<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reklama */

$this->title = 'Update Reklama: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reklamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reklama-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
