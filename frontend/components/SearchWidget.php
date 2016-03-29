<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 29.03.16
 * Time: 21:26
 */
/**
 * Seacrh widget
 * Принмает модель search. Из параметров формирует форму
 */

namespace app\components;

use yii\base\Widget;


class SearchWidget extends Widget {

    public $search;



    public function init () {

        parent::init();


        if ($this->search === null)
        {
            $this->search = false;
        }


    }

    public function run() {
        if (($this->search))
        {

            return $this->render('search',
                ['model' => $this->search]
            );
        }
    }
}