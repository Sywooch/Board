<?php

namespace backend\models;

use common\models\Region;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Town;
use yii\helpers\ArrayHelper;

/**
 * TownSearch represents the model behind the search form about `common\models\Town`.
 */
class TownSearch extends Town
{
    public $idRegion;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_region', 'default'], 'integer'],
            [['name', 'idRegion'], 'safe'],
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
        $query = Town::find();
        $query->joinWith(['idRegion']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['idRegion'] = [

            'asc' => [Region::tableName().'.name' => SORT_ASC],
            'desc' => [Region::tableName().'.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_region' => $this->id_region,
            'default' => $this->default,
        ]);

        $query->andFilterWhere(['like', Town::tableName().'.name', $this->name])
            ->andFilterWhere(['like', Region::tableName().'.name', $this->idRegion]);

        return $dataProvider;
    }

    public static function getAllRegionGrid()
    {
        $data = Region::find()->all();
        return ArrayHelper::map($data,'name','name');
    }
}
