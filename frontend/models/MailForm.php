<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 20.03.16
 * Time: 18:29
 */


namespace app\models;

use Yii;
use yii\base\Model;

class MailForm extends Model {

    public $name;
    public $email;
    public $message;
    public $uid;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message' ,'uid'], 'required'],
            [['uid'], 'integer'],

            [['name',], 'string', 'min' => 2, 'max' => 20],
            [['message',], 'string',  'max' => 255],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Ваш Email',
            'message' => 'Сообщение',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email, $board)
    {

            return \Yii::$app->mailer->compose(['html' => 'sendMsg-html', 'text' => 'sendMsg-text'], ['board' => $board, 'mail'=>$this])
                ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                ->setTo($email)
                ->setSubject('Вопрос по Вашему обяъвлению ' . \Yii::$app->name)
                ->send();

    }

}