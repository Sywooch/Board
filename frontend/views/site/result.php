<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 22:52
 */

use yii\widgets\ListView;
?>


<?=$this->render('_search', [
    'model' => $model,
    'properties' => null
])?>


<div class="col-md-2">
    <h3 class="text-center">Рекламный блок</h3>
</div>
<div class="col-md-8">
    <?php
    /*
    foreach ($models->getModels() as $model_board)
    {
        echo $this->render('_smallad', [
            'model' => $model_board,
        ]);
    }
    */
    ?>
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
    <h3 class="text-center">Рекламный блок</h3>
</div>