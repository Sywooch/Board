<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $default
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['name'], 'unique'],
            [['default'], 'integer'],
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
            'name' => 'Название',
            'default' => 'По умолчанию',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTowns()
    {
        return $this->hasMany(Town::className(), ['id_region' => 'id']);
    }

    public function AllRegions()
    {
        $data = Region::find()->all();
        return ArrayHelper::map($data,'id','name');
    }
}
