<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%object}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $enable
 *
 * @property Board[] $boards
 * @property Propeties[] $propeties
 */
class Object extends \yii\db\ActiveRecord
{

    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%object}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'enable'], 'integer'],
            [['name', 'enable'], 'required'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'sort' => 'Сортировка',
            'enable' => 'Включен'
        ];
    }

    /**
     * @author Nikolay
     * Список статусов. Активно, Закрыто
     * @return array
     */
    public function AllStatus()
    {
        $status = [self::STATUS_ENABLE=>'Активно', self::STATUS_DISABLE => 'Закрыто'];
        return $status;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoards()
    {
        return $this->hasMany(Board::className(), ['id_object' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropeties()
    {
        return $this->hasMany(Propeties::className(), ['id_object' => 'id']);
    }

    public static function AllObjects()
    {
        $data = Object::find()->where(['enable' => 1])->orderBy('sort')->all();
        return ArrayHelper::map($data,'id','name');
    }

    public static function ActiveObjModels()
    {
        return Object::find()->where(['enable' => 1])->orderBy('sort')->all();
    }
}
