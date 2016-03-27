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
 *
 * @property Board[] $boards
 * @property Propeties[] $propeties
 */
class Object extends \yii\db\ActiveRecord
{
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
            [['sort'], 'integer'],
            [['name'], 'required'],
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
            'sort' => 'Сортировка'
        ];
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

    public function AllObjects()
    {
        $data = Object::find()->all();
        return ArrayHelper::map($data,'id','name');
    }
}
