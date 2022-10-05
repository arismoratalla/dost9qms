<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Obligationrequest;

/**
 * ObligationrequestSearch represents the model behind the search form about `common\models\procurement\Obligationrequest`.
 */
class ObligationrequestSearch extends Obligationrequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['obligation_request_id', 'requested_by', 'funds_available', 'user_id'], 'integer'],
            [['os_no', 'os_date', 'particulars', 'ppa', 'account_code', 'payee', 'office', 'address', 'requested_bypos', 'funds_available_pos', 'purchase_no', 'os_type', 'dv_no'], 'safe'],
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
        $query = Obligationrequest::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'os_date'=>SORT_DESC,
                    'obligation_request_id'=>SORT_DESC,
                ]
            ],
//            'pagination' => [
//                  'pageSize' => 10,
//             ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'obligation_request_id' => $this->obligation_request_id,
            'os_date' => $this->os_date,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'os_no', $this->os_no])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'ppa', $this->ppa])
            ->andFilterWhere(['like', 'account_code', $this->account_code])
            ->andFilterWhere(['like', 'payee', $this->payee])
            ->andFilterWhere(['like', 'office', $this->office])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'requested_by', $this->requested_by])
            ->andFilterWhere(['like', 'requested_bypos', $this->requested_bypos])
            ->andFilterWhere(['like', 'funds_available', $this->funds_available])
            ->andFilterWhere(['like', 'funds_available_pos', $this->funds_available_pos])
            ->andFilterWhere(['like', 'purchase_no', $this->purchase_no])
            ->andFilterWhere(['like', 'os_type', $this->os_type])
            ->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'resp_center', $this->resp_center]);
        return $dataProvider;
    }
}
