<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Propeties */

$this->title = 'Изменить свойства: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Свойства', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="propeties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
