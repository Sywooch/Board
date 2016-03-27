<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
//    public $username;
    public $email;
    public $password;
    public $fio;
    public $phone;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
#*/

      //      ['fio', 'filter', 'filter' => 'trim'],
            ['fio', 'required'],
            ['fio', 'string', 'min' => 2, 'max' => 20],


            ['phone', 'required'],
            ['phone', 'string', 'min' => 10, 'max'=>12],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот E-mail уже занят.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'Имя на русском языке',
            'phone' => 'Телефон',
            'password' => 'Пароль',

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
   //         $user->username = $this->username;
            $user->username = $this->email;
            $user->email = $this->email;
            $user->fio  = $this->fio;
            $user->phone = $this->phone;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
