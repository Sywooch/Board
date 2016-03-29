<?php

/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 13:29
 */

/* @var $model common\models\Board */

use yii\bootstrap\Html;
use yii\bootstrap\Alert;
use yii\helpers\Url;
use app\components\MailWidget;
use app\components\ReklamaWidget;

$getphone_route = Url::toRoute(['ajax/getphone', 'id' => $model->id]);
$script = <<< JS



    function loadimg(idimg)
    {
        $("#MainImg").empty();
        $("#MainImg").html('<img class="img-rounded" src="'+idimg+'" />');
    }

    $( "#getPhone" ).click(function() {
        $.get( "$getphone_route" )
            .done(function( json )
            {
                data = JSON.parse(json);
                $('#showPhone').empty();
                $('#showPhone').addClass(' label label-info');
                $('#showPhone').html('8-'+data.phone);

            });
    });



JS;
$this->registerJs($script, yii\web\View::POS_END);
?>

<?=$this->render('/site/_search', [
    'model' => $search,
    'properties' => null
])?>

<h2 class=""><?=$model->name?></h2>
<div class="row">
    <div class="col-md-6">
    <?php
    $image = $model->getImage();
    if ($image)

        echo '<div id="MainImg"><img class="img-rounded" src="'.str_replace(Yii::getAlias('@webroot'), '', $image->getPath('500x400')).'" /></div>';
    ?>
    </div>
    <div class="col-md-1">
        <?php
        $images = $model->getImages();
        if ($images)
        {
            foreach ($images as $img)
            {
                //echo $img->urlAlias;
                $big_img = str_replace(Yii::getAlias('@webroot'), '', $img->getPath('500x400'));
                echo Html::img(str_replace(Yii::getAlias('@webroot'), '', $img->getPath('70x70')), [
                        'class' => 'img-rounded listimg',
                        'onclick' => "loadimg('$big_img')"
                    ]). '';
            }
        }
        //echo var_dump($images = $model->getImages());
        ?>
    </div>
    <div class="col-md-2 col-md-offset-2">
        <?php
        echo ReklamaWidget::widget([
            'position' => \common\models\Reklama::POS_RIGHT,
            'page' => \common\models\Reklama::PAGE_VIEW,
        ]);

        ?>
    </div>
</div>
<br /><hr />
<div class="row">

    <div class="col-md-6">
        <p class="lead">Цена: <span class="label label-success"><?php if ($model->price) echo Yii::$app->formatter->asCurrency($model->price); else echo 'Не указана'; ?></span></p>
        <p class="lead"> Продавец: <strong><?=$model->idUser->fio?></strong></p>
        <p class="lead"> Контакты: <span id="showPhone"><a class="btn btn-info" id="getPhone">Показать телефон</a></span>
            <?php
            echo MailWidget::widget([
                'button_name' => 'Написать сообщение',
                'button_style' => 'btn btn-warning',
                'heading' => 'Написать сообщение для '. $model->idUser->fio,
                'model' => $mail_model,
                'action' => ['/board/sendmsg'],
                'uid' => $model->id,
            ]);

            ?>
        </p>
        <p> <span class="glyphicon glyphicon-map-marker"></span> <?=$model->idTown->name?> <?=$model->address?> </p>
        <hr />
        <p><?=nl2br(Html::encode($model->text))?></p>
        <table class="table table-striped table-condensed">
            <?php
            foreach ($model->idAttributes as $attr)
            {
                if ($attr->idProperty) $pname = $attr->idProperty->name; else $pname = '';
                echo '<tr>
                    <td>'.  $pname .'</td>
                    <td><strong>'. $attr->value .'</strong></td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</div>
