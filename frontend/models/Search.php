<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 03.03.16
 * Time: 19:46
 */

namespace frontend\models;



use yii\base\Model;
use Yii;
use common\models\Board;
use common\models\Propeties;
use yii\data\ActiveDataProvider;


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
            [['name', 'idAttributes'], 'safe'],
            [['price_min', 'price_max'], 'safe'],

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
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider
     */
    public function search()
    {
        $filter = [

            'enable' => 1,
            'id_object' => $this->id_object,
            'id_town' => $this->id_town,
            'id_type' => $this->id_type,
            //   'like', Board::tableName().'.name', $this->name,
        ];

        $query = Board::find()->where($filter)->orderBy('date_create DESC')->limit($this->page_limit)->all();

        return $query;
    }

    public function searchProvider()
    {
        /*


        */
        $query = Board::find();
       // $query->joinWith(['idAttributes']);
        $current_time = date('Y-m-d H:i:s');
        $query->where(" `date_create` <= '$current_time' AND `date_finish` >= '$current_time' AND `enable`=1");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'date_create' => SORT_DESC,

                ]
            ],
        ]);

        //$this->load(['id_object'=>$this->id_object, 'id_type'=>$this->id_type, 'id_town'=>$this->id_town,  'name'=>$this->name]);

        $query->andFilterWhere([
            'id_object' => $this->id_object,
            'id_town' => $this->id_town,
            'id_type' => $this->id_type,
        ]);

        $query->andFilterWhere(['>', 'price', $this->price_min]);
        $query->andFilterWhere(['<', 'price', $this->price_max]);
        $query->andFilterWhere(['like', Board::tableName().'.name', $this->name]);

        return $dataProvider;
    }
}


?>