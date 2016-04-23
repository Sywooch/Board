<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Изменить пароль', ['change', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

    </p>
    <table class="table table-striped table-bordered detail-view">
        <tbody>
        <tr>
            <th><?=$model->getAttributeLabel('fio')?></th>
            <td><?=$model->fio?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('phone')?></th>
            <td><?=$model->phone?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('email')?></th>
            <td><?=$model->email?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('status')?></th>
            <td><?=$model->status?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('agency')?></th>
            <td><?=$model->agency?></td>
        </tr>
        <tr>
            <th><?=$model->getAttributeLabel('role')?></th>
            <td><?=$model->role?></td>
        </tr>
        <?php if ($model->role==$model::ROLE_AGENCY)
        {
            ?>
            <tr>
                <th><?=$model->getAttributeLabel('date_expire')?></th>
                <td><?php echo Yii::$app->formatter->asDate($model->date_expire, "php: d F");
                    //if ($model->expireDayAgency()<8) echo 'Продлить';
                    ?></td>
            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>


</div>
