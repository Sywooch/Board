<?php

namespace backend\models;

use common\models\Board;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reklama;
use yii\helpers\ArrayHelper;

/**
 * ReklamaSearch represents the model behind the search form about `common\models\Reklama`.
 */
class ReklamaSearch extends Reklama
{
    public $idBoard;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_board', 'page', 'position', 'weight'], 'integer'],
            [['idBoard' ], 'safe'],
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
        $query = Reklama::find();
        $query->joinWith(['idBoard']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['idBoard'] = [
            'asc' => [Board::tableName().'.name' => SORT_ASC],
            'desc' => [Board::tableName().'.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_board' => $this->id_board,
            'page' => $this->page,
            'position' => $this->position,
            'weight' => $this->weight,
        ]);
        $query->andFilterWhere(['like', Board::tableName().'.name', $this->idBoard]);

        return $dataProvider;
    }

    public function getAllPositionGrid()
    {
        $data = Reklama::ListPositions();
        return $data;
    }

    public function getAllPageGrid()
    {
        $data = Reklama::ListPages();
        return $data;
    }

}
