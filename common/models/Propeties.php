<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%propeties}}".
 *
 * @property integer $id
 * @property integer $id_object
 * @property integer $id_type
 * @property string $name
 * @property string $val
 *
 * @property Object $idObject
 */
class Propeties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%propeties}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_type', 'name',], 'required'],
            [['id_object', 'id_type',], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['val'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_type' => 'Тип объявления',
            'id_object' => 'Объект',
            'name' => 'Имя',
            'val' => 'Значения',
            'idType' => 'Тип объявления',
            'idObject' => 'Объект',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdType()
    {
        return $this->hasOne(Type::className(), ['id' => 'id_type']);
    }
}
