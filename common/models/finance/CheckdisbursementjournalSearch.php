<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Accounttransaction;

/**
 * AccounttransactionSearch represents the model behind the search form about `common\models\finance\Accounttransaction`.
 */
class CheckdisbursementjournalSearch extends Accounttransaction
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
        
        /*$products = Accounttransaction::find()
                ->joinWith(['metaData' => function (ActiveQuery $query) {
                    return $query
                        ->andWhere(['=', 'meta_data.published_state', 1]);
                }])
                ->joinWith(['availability' => function (ActiveQuery $query) {
                    return $query
                        ->andOnCondition(['>=', 'availability.start', strtotime('+7 days')])
                        ->andWhere(['IS', 'availability.ID', NULL]);
                }])
                ->all();*/
        
        $query = Accounttransaction::find()
                    ->where(['tbl_account_transaction.active' => 1]);
                    //->all();
                                        //->orderBy(['osdv.lddapadaitem.lddapada.batch_date ASC'])
        //$query->groupBy(['DATE(tbl_osdv.lddapadaitem.lddapada.batch_date)']);
        //$query->join('LEFT JOIN', 'tbl_request as request', 'request.request_id = tbl_account_transaction.request_id');
        $query->join('LEFT JOIN', 'tbl_osdv as osdv', 'osdv.request_id = tbl_account_transaction.request_id');
        $query->join('LEFT JOIN', 'tbl_lddapada_item as lddapadaitem', 'lddapadaitem.osdv_id = osdv.osdv_id');
        $query->join('LEFT JOIN', 'tbl_lddapada as lddapada', 'lddapada.lddapada_id = lddapadaitem.lddapada_id');
        
        //$query->leftJoin('tbl_request', 'tbl_request.request_id = tbl_accounttransaction.request_id');  
        //$query->leftJoin('tbl_lddapadaitem as lddapadaitem', 'osdv.osdv_id = osdv_id');  
            
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['osdv.lddapadaitem.lddapada.batch_date'=>SORT_DESC, 'account_transaction_id'=>SORT_DESC]],
            //->orderBy(['housingType.occupant.first_name ASC']),
            'pagination' => false,
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
        
        $request_date_s = date('Y-m-d', strtotime("-1 day", strtotime('2021-11-01')));
        $request_date_e = date('Y-m-d', strtotime("+1 day", strtotime('2021-11-30')));
        
        $query->andFilterWhere(['between', 'lddapada.batch_date', $request_date_s, $request_date_e]);

        return $dataProvider;
    }
}
