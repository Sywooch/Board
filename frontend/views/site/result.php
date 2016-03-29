<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 22:52
 */

use yii\widgets\ListView;
use app\components\ReklamaWidget;
?>



<div class="col-md-2">
    <?php
    echo ReklamaWidget::widget([
        'position' => \common\models\Reklama::POS_LEFT,
        'page' => \common\models\Reklama::PAGE_RESULT,
    ]);

    ?>
</div>
<div class="col-md-8">

    <?=
    ListView::widget([
        'pager' => [
            'firstPageLabel' => 'Первая',
            'lastPageLabel' => 'Последняя',
        ],
        'dataProvider' => $models,
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],

        'itemView' => '_smallad',
    ]);
    ?>
</div>
<div class="col-md-2">
    <?php
    echo ReklamaWidget::widget([
        'position' => \common\models\Reklama::POS_RIGHT,
        'page' => \common\models\Reklama::PAGE_RESULT,
    ]);

    ?>
</div>