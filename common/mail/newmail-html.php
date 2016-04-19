<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $board common\models\Board */
/* @var $mail frontend\models\MailForm */

$boardLink = Yii::$app->urlManager->createAbsoluteUrl(['board/view', 'id' => $board->id]);
?>
<div class="password-reset">
    <h3>Новое объявление</h3>
    <h4><?=Html::encode($board->name)?></h4>
    <p>От пользователят: <?= Html::encode($board->idUser->fio) ?></p>
    <p><?=Html::encode($board->idTown->name)?> <?=Html::encode($board->address)?></p>
    <p><?=Html::encode($board->idType->name)?> <?=Html::encode($board->idObject->name)?></p>
    <p><?=Html::encode($board->text)?></p>
    <p>Просмотреть <?= Html::a($board->name, $boardLink) ?></p>


</div>