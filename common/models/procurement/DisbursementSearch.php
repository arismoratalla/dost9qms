<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Disbursement;

/**
 * DisbursementSearch represents the model behind the search form about `common\models\procurement\Disbursement`.
 */
class DisbursementSearch extends Disbursement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dv_id', 'certified_a', 'certified_b', 'approved', 'taxable', 'funding_id', 'supporting_docs', 'cash_available', 'subject_ada', 'user_id'], 'integer'],
            [['dv_no', 'dv_date', 'particulars', 'payee', 'address', 'os_no', 'dv_type', 'po_no', 'fundings'], 'safe'],
            [['dv_amount', 'dv_total'], 'number'],
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
        $query = Disbursement::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['dv_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'dv_id' => $this->dv_id,
            'dv_date' => $this->dv_date,
            'dv_amount' => $this->dv_amount,
            'dv_total' => $this->dv_total,
            'certified_a' => $this->certified_a,
            'certified_b' => $this->certified_b,
            'approved' => $this->approved,
            'taxable' => $this->taxable,
            'funding_id' => $this->funding_id,
            'supporting_docs' => $this->supporting_docs,
            'cash_available' => $this->cash_available,
            'subject_ada' => $this->subject_ada,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'dv_no', $this->dv_no])
            ->andFilterWhere(['like', 'particulars', $this->particulars])
            ->andFilterWhere(['like', 'payee', $this->payee])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'os_no', $this->os_no])
            ->andFilterWhere(['like', 'dv_type', $this->dv_type])
            ->andFilterWhere(['like', 'po_no', $this->po_no])
            ->andFilterWhere(['like', 'fundings', $this->fundings]);

        return $dataProvider;
    }
}
