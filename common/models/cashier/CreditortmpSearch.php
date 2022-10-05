<?php

namespace common\models\cashier;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cashier\Creditortmp;

/**
 * CreditortmpSearch represents the model behind the search form about `common\models\cashier\Creditortmp`.
 */
class CreditortmpSearch extends Creditortmp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creditor_id', 'creditor_type_id', 'requested_by', 'active'], 'integer'],
            [['name', 'address', 'bank_name', 'account_number', 'tin_number', 'date_request'], 'safe'],
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
        $query = Creditortmp::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['creditor_id'=>SORT_DESC]]
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
            'requested_by' => $this->requested_by,
            'date_request' => $this->date_request,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'tin_number', $this->tin_number]);

        return $dataProvider;
    }
}
