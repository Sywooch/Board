<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reklama;

/**
 * ReklamaSearch represents the model behind the search form about `common\models\Reklama`.
 */
class ReklamaSearch extends Reklama
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_board', 'page', 'position', 'weight'], 'integer'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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

        return $dataProvider;
    }
}
