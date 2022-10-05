<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\UnitType;

/**
 * UnittypeSearch represents the model behind the search form about `common\models\procurement\Unittype`.
 */
class UnittypeSearch extends UnitType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_type_id'], 'integer'],
            [['name_short', 'name_long'], 'safe'],
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
        $query = UnitType::find();

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
            'unit_type_id' => $this->unit_type_id,
        ]);

        $query->andFilterWhere(['like', 'name_short', $this->name_short])
            ->andFilterWhere(['like', 'name_long', $this->name_long]);

        return $dataProvider;
    }
}
