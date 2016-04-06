<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%town}}".
 *
 * @property integer $id
 * @property integer $id_region
 * @property string $name
 * @property integer $default
 * @property integer $sort
 *
 * @property Board[] $boards
 * @property Region $idRegion
 */
class Town extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%town}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_region', 'name'], 'required'],
            [['id_region', 'default', 'sort'], 'integer'],
            [['name'], 'unique',  'targetAttribute' => ['id_region', 'name']],
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
            'id_region' => 'Регион',
            'name' => 'Название',
            'default' => 'По умолчанию',
            'sort' => 'Сортировка',
            'idRegion' => 'Регион',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoards()
    {
        return $this->hasMany(Board::className(), ['id_town' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'id_region']);
    }

    public function AllTowns()
    {
        $data = Town::find()->all();
        return ArrayHelper::map($data,'id','name');
    }

    /**
     * Array of Towns with optgroup
     * @return array
     */
    public function FrAllTowns()
    {
        $data = Town::find()->orderBy('id_region')->with('idRegion')->all();
        $region = ArrayHelper::map($data,'id_region','idRegion.name');

        $allarr = [];
        foreach ($region as $key=>$val)
        {
            $arr = [];
            foreach ($data as $value)
            {
                if ($value->id_region==$key)
                {
                    $arr[$value->id] = $value->name;
                }
            }
            $allarr[$val] = $arr;
        }
       return $allarr;
    }
}
