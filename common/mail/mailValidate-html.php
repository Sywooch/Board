<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/check-email', 'token' => $user->valid_token]);
?>
<div class="password-reset">
    <p>Здравствуйте, <?= Html::encode($user->fio) ?>,</p>

    <p>Пройдите по ссылке ниже для подтверждения Email:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
