<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $board common\models\Board */
/* @var $mail frontend\models\MailForm */

$boardLink = Yii::$app->urlManager->createAbsoluteUrl(['board/view', 'id' => $board->id]);
?>

    Новое объявление
    <?=Html::encode($board->name)?>

От пользователят: <?= Html::encode($board->idUser->fio) ?>
<?=Html::encode($board->idTown->name)?> <?=Html::encode($board->address)?>
    <?=Html::encode($board->idType->name)?> <?=Html::encode($board->idObject->name)?>
    <?=Html::encode($board->text)?>

Просмотреть <?= Html::a($board->name, $boardLink) ?>


