<?php

namespace common\models\cashier;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cashier\Lddapadaitem;

/**
 * LddapadaitemSearch represents the model behind the search form about `common\models\cashier\Lddapadaitem`.
 */
class LddapadaitemSearch extends Lddapadaitem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lddapada_item_id', 'lddapada_id', 'creditor_id', 'creditor_type_id', 'alobs_id', 'expenditure_object_id'], 'integer'],
            [['name', 'bank_name', 'account_number', 'check_number'], 'safe'],
            [['gross_amount'], 'number'],
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
        $query = Lddapadaitem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['lddapada_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //$query->joinWith(['expenditureObject']);
        //$query->joinWith(['creditor as creditor']);

        // grid filtering conditions
        $query->andFilterWhere([
            'lddapada_item_id' => $this->lddapada_item_id,
            'lddapada_id' => $this->lddapada_id,
            'creditor_id' => $this->creditor_id,
            'creditor_type_id' => $this->creditor_type_id,
            'gross_amount' => $this->gross_amount,
            'alobs_id' => $this->alobs_id,
            'expenditure_object_id' => $this->expenditure_object_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'check_number', $this->check_number]);

        return $dataProvider;
    }
}
