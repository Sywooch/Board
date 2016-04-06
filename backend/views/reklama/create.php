<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Reklama */

$this->title = 'Создать рекламу для: '. $board->name;
$this->params['breadcrumbs'][] = ['label' => 'Реклама', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reklama-create">

    <h2>Создать рекламу для <strong><?=$board->idType->name?> <?=$board->idObject->name?> <?=$board->name?></strong></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
