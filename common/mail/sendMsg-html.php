<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $board common\models\Board */
/* @var $mail frontend\models\MailForm */

$boardLink = Yii::$app->urlManager->createAbsoluteUrl(['board/view', 'id' => $board->id]);
?>
<div class="password-reset">
    <p>Здравствуйте, <?= Html::encode($board->idUser->fio) ?></p>

    <p>По Вашем объявлению <?= Html::a($board->name, $boardLink) ?> задан вопрос</p>

    <p>От <strong><?=Html::encode($mail->name)?></strong> <?= Html::a($mail->email, 'mailto:'.$mail->email) ?></p>
    <p>
        <?= Html::encode($mail->message) ?>
    </p>
</div>
