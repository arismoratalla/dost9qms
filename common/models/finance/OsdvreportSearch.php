<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

use common\models\finance\Request;
use common\models\finance\Requestpayroll;

/**
 * RequestSearch represents the model behind the search form about `common\models\finance\Request`.
 */
class OsdvreportSearch extends Request
{
    public $request_date_s;
    public $request_date_e;
    
    public $payee_id;
    public $os_id;
    public $dv_id;
    public $obligation_type_id;
    /**
     * @inheritdoc
     */ 
    public function rules()
    {
        return [
            //[['request_id', 'request_number', 'request_type_id', 'status_id', 'created_by'], 'integer'],
            [['request_id', 'request_number', 'request_type_id', 'status_id', 'created_by', 'obligation_type_id', ], 'integer'],
            [['request_date', 'payee_id', 'particulars'], 'safe'],
            [['amount'], 'number'],
            [['os_id', 'dv_id'], 'safe']
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
        $query = Request::find();
        //$query2 = Requestpayroll::find();
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['request_id'=>SORT_DESC]]
        ]);
        
        /*$dataProvider2 = new ActiveDataProvider([
            'query' => $query2,
            'sort'=> ['defaultOrder' => ['request_id'=>SORT_DESC]]
        ]);

        $data = array_merge($dataProvider->getModels(), $dataProvider2->getModels());
        
        $dataProvider = new ArrayDataProvider([
          'allModels' => $data
        ]);*/
        
        /*$dataProvider = new ActiveDataProvider([
            'query' => $data,
            'sort'=> ['defaultOrder' => ['request_id'=>SORT_DESC]]
        ]);*/
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$query->joinWith(['osdv']);
        $query->joinWith(['osdv.os as os']);
        $query->joinWith(['osdv.dv as dv']);
        $query->joinWith(['osdv.lddapadaitem.lddapada as lddapada']);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'request_id' => $this->request_id,
            'tbl_request.obligation_type_id' => $this->obligation_type_id,
            'request_type_id' => $this->request_type_id,
            'payee_id' => $this->payee_id,
            'amount' => $this->amount,
            'tbl_request.status_id' => $this->status_id,
            'tbl_request.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['>=', 'tbl_request.status_id', 70]);
        
        //$query->andFilterWhere(['like', 'request_number', $this->request_number]);

        $query->andFilterWhere(['like', 'os.os_id', $this->os_id]);
        $query->andFilterWhere(['like', 'dv.dv_id', $this->dv_id]);
        //$query->andFilterWhere(['tbl_request.osdv.os.os_id' => $this->os_id]);
        
        $query->andFilterWhere(['between', 'lddapada.batch_date', $this->request_date_s, $this->request_date_e]);
        //$query->andFilterWhere(['between', 'request_date', $this->request_date_s, $this->request_date_e]);
        //$query->andWhere('request.osdv.os.os_number LIKE "%' . $this->os_id . '%" ');
        return $dataProvider;
    }
}
