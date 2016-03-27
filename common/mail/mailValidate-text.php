<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/check-email', 'token' => $user->valid_token]);
?>

    Здравствуйте, <?= Html::encode($user->fio) ?>,

    Пройдите по ссылке ниже для подтверждения Email:

    <?= Html::a(Html::encode($resetLink), $resetLink) ?>

