<?php

namespace common\models\budget;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\budget\Budgetallocation;

/**
 * BudgetallocationSearch represents the model behind the search form about `common\models\budget\Budgetallocation`.
 */
class BudgetallocationSearch extends Budgetallocation
{
    /**
     * @inheritdoc
     */
    public $selectyear;
    public function rules()
    {
        return [
            [['budget_allocation_id', 'section_id', 'year'], 'integer'],
            [['amount'], 'number'],
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
        $query = Budgetallocation::find();

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
            'budget_allocation_id' => $this->budget_allocation_id,
            'section_id' => $this->section_id,
            'year' => $this->year,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
