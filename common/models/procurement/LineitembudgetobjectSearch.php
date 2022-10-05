<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Lineitembudgetobject;

/**
 * LineitembudgetobjectSearch represents the model behind the search form about `common\models\procurement\Lineitembudgetobject`.
 */
class LineitembudgetobjectSearch extends Lineitembudgetobject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['line_item_budget_object_id', 'line_item_budget_id', 'expenditure_object_id'], 'integer'],
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
        $query = Lineitembudgetobject::find()->joinWith('details');

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
            'line_item_budget_object_id' => $this->line_item_budget_object_id,
            'line_item_budget_id' => $this->line_item_budget_id,
            'expenditure_object_id' => $this->expenditure_object_id,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
