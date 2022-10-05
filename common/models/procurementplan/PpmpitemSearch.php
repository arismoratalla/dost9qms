<?php

namespace common\models\procurementplan;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurementplan\Ppmpitem;

/**
 * PpmpitemSearch represents the model behind the search form about `common\models\procurementplan\Ppmpitem`.
 */
class PpmpitemSearch extends Ppmpitem
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['ppmp_item_id', 'ppmp_id', 'ppmp_item_category_id', 'quantity', 'unit', 'mode_of_procurement', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12'], 'integer'],
            [['selectyear','code', 'description', 'item_specification'], 'safe'],
            [['cost', 'estimated_budget'], 'number'],
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
        $query = Ppmpitem::find();

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
            'ppmp_item_id' => $this->ppmp_item_id,
            'ppmp_id' => $this->ppmp_id,
            'ppmp_item_category_id' => $this->ppmp_item_category_id,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'cost' => $this->cost,
            'estimated_budget' => $this->estimated_budget,
            'mode_of_procurement' => $this->mode_of_procurement,
            'q1' => $this->q1,
            'q2' => $this->q2,
            'q3' => $this->q3,
            'q4' => $this->q4,
            'q5' => $this->q5,
            'q6' => $this->q6,
            'q7' => $this->q7,
            'q8' => $this->q8,
            'q9' => $this->q9,
            'q10' => $this->q10,
            'q11' => $this->q11,
            'q12' => $this->q12,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'item_specification', $this->item_specification]);

        return $dataProvider;
    }
}
