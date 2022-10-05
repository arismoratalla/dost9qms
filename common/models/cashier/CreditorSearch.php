<?php

namespace common\models\cashier;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cashier\Creditor;

/**
 * CreditorSearch represents the model behind the search form about `common\models\cashier\Creditor`.
 */
class CreditorSearch extends Creditor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creditor_id', 'creditor_type_id'], 'integer'],
            [['name', 'bank_name', 'account_number'], 'safe'],
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
        $query = Creditor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'creditor_type_id' => SORT_ASC,
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'creditor_id' => $this->creditor_id,
            'creditor_type_id' => $this->creditor_type_id,
            'active' => 1,
        ]);
        
        if(($this->request_type_id == 1)){
            $query->andFilterWhere(['in', 'creditor_type_id', $this->creditor_type_id]);
        }elseif(($this->request_type_id == 2)){
            $query->andFilterWhere(['in', 'creditor_type_id', $this->creditor_type_id]);
        }elseif(($this->request_type_id == 5)){
            $query->andFilterWhere(['in', 'creditor_type_id', $this->creditor_type_id]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'account_number', $this->account_number]);

        return $dataProvider;
    }
}
