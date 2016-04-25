<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%money}}".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $value
 * @property string $date
 * @property string $info
 * @property integer $complete
 *
 * @property User $idUser
 */
class Money extends \yii\db\ActiveRecord
{
    const COMPLETE_PROCESS = 0;
    const COMPLETE_SUCCESS = 1;
    const COMPLETE_FAIL = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%money}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'value',  'info', 'complete'], 'required'],
            [['id_user', 'value', 'complete'], 'integer'],
            [['date'], 'safe'],
            [['info'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Пользователь',
            'value' => 'Сумма',
            'date' => 'Дата',
            'info' => 'Информация',
            'complete' => 'Выполнено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * Set role in Base
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->isNewRecord)
        {
            $this->date = date('Y-m-d H:i:s');
        }
        return true;
    }
}
