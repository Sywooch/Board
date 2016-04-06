<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Propeties */

$this->title = 'Создать свойство';
$this->params['breadcrumbs'][] = ['label' => 'Свойства', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="propeties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
