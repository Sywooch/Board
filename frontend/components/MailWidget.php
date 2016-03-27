<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 20.03.16
 * Time: 18:27
 */

namespace app\components;

use yii\base\Widget;


class MailWidget extends Widget {

    public $button_name;
    public $button_style;
    public $heading;
    public $model;
    public $action;
    public $uid;

    public function init () {
        parent::init();
        if ($this->button_name === null)
        {
            $this->button_name = 'Задать вопрос';
        }
        if ($this->button_style === null)
        {
            $this->button_style = 'btn btn-primary';
        }
        if ($this->heading === null)
        {
            $this->heading = 'Отправть сообщение';
        }
        if ($this->action === null)
        {
            $this->action = '';
        }

    }

    public function run() {
        return $this->render(
            'mail', [
                'button_name' => $this->button_name,
                'button_style' => $this->button_style,
                'heading' => $this->heading,
                'model' => $this->model,
                'action' => $this->action,
                'uid' => $this->uid,
            ]
        );
    }
}