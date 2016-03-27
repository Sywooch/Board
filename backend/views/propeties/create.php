<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Propeties */

$this->title = 'Create Propeties';
$this->params['breadcrumbs'][] = ['label' => 'Propeties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="propeties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
