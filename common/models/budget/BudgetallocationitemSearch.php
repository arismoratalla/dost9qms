<?php

namespace common\models\budget;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\budget\Budgetallocationitem;

/**
 * BudgetallocationitemSearch represents the model behind the search form about `common\models\budget\Budgetallocationitem`.
 */
class BudgetallocationitemSearch extends Budgetallocationitem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['budget_allocation_item_id', 'budget_allocation_id', 'category_id'], 'integer'],
            [['name', 'code'], 'safe'],
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
        $query = Budgetallocationitem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    //'expenditure_object_id' => SORT_ASC, 
                    'expenditure_class_id' => SORT_ASC, 
                    'expenditure_subclass_id' => SORT_ASC, 
                    'name' => SORT_ASC, 
                    
                ]
            ],*/
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'budget_allocation_item_id' => $this->budget_allocation_item_id,
            'budget_allocation_id' => $this->budget_allocation_id,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
