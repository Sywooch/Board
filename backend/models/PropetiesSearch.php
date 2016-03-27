<?php

namespace backend\models;

use common\models\Type;
use Yii;
use yii\base\Model;
use \common\models\Object;
use yii\data\ActiveDataProvider;
use common\models\Propeties;
use yii\helpers\ArrayHelper;

/**
 * PropetiesSearch represents the model behind the search form about `common\models\Propeties`.
 */
class PropetiesSearch extends Propeties
{
    public $idObject;
    public $idType;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_object', 'id_type'], 'integer'],
            [['name', 'val', 'idObject', 'idType'], 'safe'],
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
        $query = Propeties::find();
        $query->joinWith(['idObject', 'idType']);

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

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_objects' => $this->id_object,
        ]);

        $query->andFilterWhere(['like', Propeties::tableName().'.name', $this->name])
            ->andFilterWhere(['like', Object::tableName().'.name', $this->idObject])
            ->andFilterWhere(['like', Type::tableName().'.name', $this->idType])
            ->andFilterWhere(['like', 'val', $this->val]);

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
}
