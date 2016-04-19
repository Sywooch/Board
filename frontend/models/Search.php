<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 19:46
 */

namespace frontend\models;



use common\models\Attributes;
use yii\base\Model;
use Yii;
use common\models\Board;
use common\models\Propeties;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;



class Search extends Model
{
    public $id;
    public $id_town;
    public $id_object;
    public $name;
    public $id_type;
    public $properties; // Array of property
    public $price_min;
    public $price_max;
    public $page_limit = 10;
    public $idAttributes;
    public $board;

    public function beforeValidate()
    {

        if ($this->price_min)
            $this->price_min = intval(str_replace(' ', '', $this->price_min)); // Костыли
        if ($this->price_max)
            $this->price_max = intval(str_replace(' ', '', $this->price_max)); // Костыли
            return true;

    }

    public function rules()
    {
        return [
            [['id', 'id_object', 'id_town', 'id_type', ], 'integer'],
            [['name', 'idAttributes', 'board'], 'safe'],
            [['price_min', 'price_max', 'properties'], 'safe'],

        ];
    }

    /**
     * @return array|bool
     */
    public function loadProperties()
    {
        if (($this->id_object)&&($this->id_type))
        {
            $propeties = Propeties::findAll(['id_object' => $this->id_object, 'id_type' => $this->id_type]);
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
     * @author Nikolay
     * @todo Реализовать по человечески поиск атрибутов
     * Жесткие костыли при поиске с атрибутами
     *
     * @return ActiveDataProvider
     */
     public function searchProvider()
    {


            // ФОрмирование строки поиска по атрибутам
            $i = 1;
            $select = '';
        if($this->properties)
        {

            $id_arr = [];


            foreach ($this->properties as $id_prop => $value)
            {
                if ($value!='') // Атрибут есть, и выбран
                {

                    if ($i>1)
                    {
                        // Второй и последующие атрибуты, фильтруем массив


                        $attr = Attributes::find()->where(['id_prop'=>$id_prop, 'value'=>trim($value)])->orderBy('id_board')->all();
                        $tmp_arr = ArrayHelper::map($attr, 'id_board', 'id_board');
                        $id_arr = array_intersect_key($id_arr, $tmp_arr);
                    }

                    else
                    {
                        // Первый атрибут, делаем запрос по атрибуту, записываем в массив
                        $attr = Attributes::find()->where(['id_prop'=>$id_prop, 'value'=>trim($value)])->orderBy('id_board')->all();
                        $id_arr = ArrayHelper::map($attr, 'id_board', 'id_board');
                    }
                    #*/
                    $i++;

                }


            }


            $select =  implode(",", $id_arr);

        }

            /**
             * @todo Сделать поиск через DAO
             * Сейчас все должно работать через SQlDataProvider
             */

            $query = Board::find();

            $current_time = date('Y-m-d H:i:s');
            $query->where(" `date_create` <= '$current_time' AND `date_finish` >= '$current_time' AND `enable`=1");


            $query->andFilterWhere([
                'id_object' => $this->id_object,
                'id_town' => $this->id_town,
                'id_type' => $this->id_type,
            ]);

            $query->andFilterWhere(['>', 'price', $this->price_min]);
            $query->andFilterWhere(['<', 'price', $this->price_max]);
            $query->andFilterWhere(['like', Board::tableName().'.name', $this->name]);
            if ($i>1) // Были выбраны атрибуты
            {
                if ($select==null)
                    $query->andOnCondition(' 1=2');
                else
                    $query->andOnCondition("id IN ($select)");
            }



            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 20,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'date_create' => SORT_DESC,

                    ]
                ],
            ]);

        return $dataProvider;
    }
}


?>