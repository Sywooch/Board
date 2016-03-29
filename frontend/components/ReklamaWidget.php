<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 29.03.16
 * Time: 17:13
 */

namespace app\components;
use common\models\Reklama;
use yii\base\Widget;


class ReklamaWidget extends Widget {

    public $page;
    public $position;
    public $random;
    public $limit;


    public function init () {

        if (($this->page === null)or($this->position === null))
        {
            $this->position = false;
            $this->page = false;
        }

        if ($this->random === null)
        {
            $this->random = false;
        }
        if ($this->limit === null)
        {
            $this->limit = 5;
        }

    }

    public function run() {
        if (($this->page)&&($this->position))
        {
            $models = Reklama::find()->where(['page' => $this->page, 'position'=> $this->position])->orderBy('weight DESC')->limit($this->limit)->all();
            return $this->render(
                'reklama', ['models' => $models]
            );
        }
    }
}