<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 20.03.16
 * Time: 19:41
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $board common\models\Board */
/* @var $mail frontend\models\MailForm */

$boardLink = Yii::$app->urlManager->createAbsoluteUrl(['board/view', 'id' => $board->id]);
?>

    Здравствуйте, <?= Html::encode($board->idUser->fio) ?>

    По Вашем объявлению <?= Html::a($board->name, $boardLink) ?> задан вопрос

    От <?=Html::encode($mail->name)?> <?= Html::a($mail->email, 'mailto:'.$mail->email) ?>

        <?= Html::encode($mail->message) ?>
