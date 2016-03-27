<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%board}}".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_object
 * @property integer $id_town
 * @property integer $id_type
 * @property string $date_create
 * @property string $date_finish
 * @property string $name
 * @property string $text
 * @property string $address
 * @property double $price
 * @property integer $looks - Просмотр объявления
 * @property integer $views - Запрос контактов
 * @property integer $enable - Включено -1, Выключено -0. 1 по умолчанию
 * @property integer $marked - Выделение
 *
 * @property User $idUser
 * @property Object $idObject
 * @property Town $idTown
 * @property Type $idType
 */
class Board extends \yii\db\ActiveRecord
{

    public $image1;
    public $image2;
    public $image3;
    public $image4;
    public $image5;

    public $delimg1;
    public $delimg2;
    public $delimg3;
    public $delimg4;
    public $delimg5;

    public $property;

    // Типы объявлений
    const TYPE_SALE = 1; // Продам
    const TYPE_RENT = 2; // Сдам
    const TYPE_BUY = 3; // Куплю
    const TYPE_TAKE = 4; // Сниму

    // Сценарии подачи объявлений
    const SCENARIO_SALE = 'sale';
    const SCENARIO_RENT = 'rent';

    // Виды выделений объявлений
    const MARK_DEFAULT = 0;
    const MARK_YELLOW = 1;
    const MARK_RED = 2;

    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;


    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%board}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_town', 'id_type', 'name', 'text' ], 'required'],
            [['address', 'price' ], 'required', 'on' => self::SCENARIO_RENT],
            [['address', 'price' ], 'required', 'on' => self::SCENARIO_SALE],
            [['id_user', 'id_object', 'id_town', 'id_type', 'views', 'looks', 'enable', 'marked', 'delimg1', 'delimg2', 'delimg3', 'delimg4', 'delimg5', ], 'integer'],
            [['date_create', 'property', 'date_finish', 'price'], 'safe'],
            [['text'], 'string'],
           // [['price'], 'string', 'max'=>15],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
            [['image1', 'image2', 'image3', 'image4', 'image5', ], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Автор',
            'id_object' => 'Объект',
            'id_town' => 'Город',
            'id_type' => 'Тип',
            'date_create' => 'Дата',
            'date_finish' => 'Дата завершения',
            'name' => 'Название',
            'text' => 'Текст объявления',
            'address' => 'Адрес',
            'price' => 'Цена',
            'looks' => 'Просмотры',
            'views' => 'Запросы',
            'enable' => 'Активность',
            'marked' => 'Выделение',
            'idUser' => 'Автор',
            'idObject' => 'Объект',
            'idTown' => 'Город',
            'idType' => 'Тип',
        ];
    }

    /**
     * @return array|bool
     */
    public function LoadProperty()
    {
        if ($this->id_object)
        {
            $propeties = Propeties::findAll(['id_object' => $this->id_object, 'id_type'=>$this->id_type]);
            $result = [];
            foreach ($propeties as $prop)
            {
                if ($prop->val)
                    $arr = explode(',', $prop->val);
                else
                    $arr = false;

                $result[] = array('id' => $prop['id'], 'name' => $prop['name'], 'val' => $arr);
            }
            return $result;
        }
        else
            return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }

    public function getIdAttributes()
    {
        return $this->hasMany(Attributes::className(), ['id_board' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTown()
    {
        return $this->hasOne(Town::className(), ['id' => 'id_town']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdType()
    {
        return $this->hasOne(Type::className(), ['id' => 'id_type']);
    }

    public function generateFileName()
    {
        $name = uniqid();
        return $name;
    }

    /**
     * @author Nikolay
     * Определение статуса объявления. Активна или не активна
     * @return bool
     */
    public function Active()
    {
        $start_time = strtotime($this->date_create);
        $stop_time = strtotime($this->date_finish);
        $current_time = time();
        if (($this->enable==self::STATUS_ENABLE)&& ($current_time>=$start_time) && ($current_time<=$stop_time))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @author Nikolay
     * Список статусов
     * @return array
     */
    public function AllStatus()
    {
        $status = [self::STATUS_ENABLE=>'Активно', self::STATUS_DISABLE => 'Закрыто'];
        return $status;
    }

    public function ListMarked()
    {
        $marked = [self::MARK_DEFAULT=>'Без подсветки', self::MARK_YELLOW => 'Желтое', self::MARK_RED => 'Красная рамка'];
        return $marked;
    }

    public function beforeSave($insert)
    {
        if ($this->price)
            $this->price = intval(str_replace(' ', '', $this->price));

        if ($this->isNewRecord) {

            $start_time = time()+Yii::$app->params['brd_start'];
            $finish_time = time()+Yii::$app->params['brd_finish'];
            $this->date_create = date('Y-m-d H:i:s', $start_time);
            $this->date_finish = date('Y-m-d H:i:s', $finish_time);
            $this->id_user = Yii::$app->user->id;

        }
        return true;
    }

    public function afterSave ($insert, $changedAttributes)
    {
        if (!$insert) // Check update record.
        {
            // Удаляем старые свойства
            Attributes::deleteAll(['id_board' => $this->id]);

        }
        if ($this->property)
        {
            // Save attributes from prop
            foreach ($this->property as $key=>$prop)
            {
                $model_attr = new Attributes();
                $model_attr->id_board = $this->id;
                $model_attr->id_prop = $key;
                $model_attr->value = $prop;
                $model_attr->save();
            }
        }
    }
}
