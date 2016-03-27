<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 22:52
 */


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
    foreach ($models as $model_board)
    {
        echo $this->render('_smallad', [
            'model' => $model_board,
        ]);
    }
    ?>
</div>
<div class="col-md-2">
    <h3 class="text-center">Рекламный блок</h3>
</div>