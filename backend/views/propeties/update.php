<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Propeties */

$this->title = 'Update Propeties: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Propeties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="propeties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
