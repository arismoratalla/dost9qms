<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Accounttransaction;

/**
 * AccounttransactionSearch represents the model behind the search form about `common\models\finance\Accounttransaction`.
 */
class AccounttransactionSearch extends Accounttransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_transaction_id', 'request_id', 'account_id', 'transaction_type'], 'integer'],
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
        $query = Accounttransaction::find();
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
            'account_transaction_id' => $this->account_transaction_id,
            'request_id' => $this->request_id,
            'account_id' => $this->account_id,
            'transaction_type' => $this->transaction_type,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
