<?php

namespace backend\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Town;
use common\models\User;
use common\models\Board;
use common\models\Object;
use common\models\Type;
use yii\helpers\ArrayHelper;

/**
 * BoardSearch represents the model behind the search form about `common\models\Board`.
 */
class BoardSearch extends Board
{
    public $idType;
    public $idObject;
    public $idUser;
    public $idTown;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_object', 'id_town', 'id_type', 'views', 'enable', 'looks'], 'integer'],
            [['name', 'text', 'address', 'idType', 'idObject', 'idUser', 'idTown' ], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Board::find();
        $query->joinWith(['idObject', 'idType', 'idTown', 'idUser']);
        $query->orderBy('date_create DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['idObject'] = [
            'asc' => [Object::tableName().'.name' => SORT_ASC],
            'desc' => [Object::tableName().'.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['idType'] = [
            'asc' => [Type::tableName().'.name' => SORT_ASC],
            'desc' => [Type::tableName().'.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['idTown'] = [
            'asc' => [Town::tableName().'.name' => SORT_ASC],
            'desc' => [Town::tableName().'.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['idUser'] = [
            'asc' => [User::tableName().'.fio' => SORT_ASC],
            'desc' => [User::tableName().'.fio' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_user' => $this->id_user,
            'id_object' => $this->id_object,
            'id_town' => $this->id_town,
            'id_type' => $this->id_type,
            'price' => $this->price,
            'views' => $this->views,
            'looks' => $this->looks,
            'enable' => $this->enable,
        ]);

        $query->andFilterWhere(['like', Board::tableName().'.name', $this->name])
            ->andFilterWhere(['like', Object::tableName().'.name', $this->idObject])
            ->andFilterWhere(['like', Type::tableName().'.name', $this->idType])
            ->andFilterWhere(['like', Town::tableName().'.name', $this->idTown])
            ->andFilterWhere(['like', User::tableName().'.fio', $this->idUser])

            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }

    public static function getAllTypeGrid()
    {
        $data = Type::find()->all();
        return ArrayHelper::map($data,'name','name');
    }

    public static function getAllObjectGrid()
    {
        $data = Object::find()->all();
        return ArrayHelper::map($data,'name','name');
    }

    public static function getAllTownGrid()
    {
        $data = Town::find()->all();
        return ArrayHelper::map($data,'name','name');
    }
}
