<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attributes}}".
 *
 * @property integer $id
 * @property integer $id_board
 * @property integer $id_prop
 * @property string $value
 */
class Attributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attributes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_board', 'id_prop', 'value'], 'required'],
            [['id_board', 'id_prop'], 'integer'],
            [['value'], 'string', 'max' => 100]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProperty()
    {
        return $this->hasOne(Propeties::className(), ['id' => 'id_prop']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_board' => 'Id Board',
            'id_prop' => 'Id Prop',
            'value' => 'Value',
        ];
    }
}
