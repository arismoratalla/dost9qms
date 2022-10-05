<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Requestpayroll;

/**
 * RequestpayrollSearch represents the model behind the search form about `common\models\finance\Requestpayroll`.
 */
class RequestpayrollSearch extends Requestpayroll
{
    public $request_date_s;
    public $request_date_e;
    public $payment_date;
    public $payee_id;
    public $os_id;
    public $dv_id;
    public $obligation_type_id;
    //public $request_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_payroll_id', 'request_id', 'payment_date', 'os_id', 'dv_id', 'creditor_id', 'obligation_type_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = Requestpayroll::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['request_payroll_id'=>SORT_DESC]]
        ]);

        $this->load($params);
        
        $query->joinWith(['osdv']);
        $query->joinWith(['osdv.os as os']);
        $query->joinWith(['osdv.dv as dv']);
        //$query->joinWith(['osdv.lddapadaitem.lddapada as lddapada']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'request_payroll_id' => $this->request_payroll_id,
            'request_id' => $this->request_id,
            'creditor_id' => $this->creditor_id,
            'tbl_request_payroll.osdv.request.obligation_type_id' => $this->obligation_type_id,
            'tbl_request_payroll.osdv.request.obligation_type_id' => $this->obligation_type_id,
            'tbl_request_payroll.status_id' => 70,
            //'tbl_request.status_id' => 70,
            //'tbl_request.status_id' => 70,
        ]);

        //$query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'os.os_id', $this->os_id]);
        $query->andFilterWhere(['like', 'dv.dv_id', $this->dv_id]);
        
        $query->andFilterWhere(['between', 'lddapada.batch_date', $this->request_date_s, $this->request_date_e]);
        //$query->andFilterWhere(['between', 'lddapada.batch_date', $this->request_date_s, $this->request_date_e]);

        return $dataProvider;
    }
}
