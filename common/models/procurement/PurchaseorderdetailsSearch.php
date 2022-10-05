<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Purchaseorderdetails;

/**
 * PurchaseorderdetailsSearch represents the model behind the search form about `common\models\procurement\Purchaseorderdetails`.
 */
class PurchaseorderdetailsSearch extends Purchaseorderdetails
{
    /**
     * @inheritdoc
     */
    public $purchaseordernumber;
    public $itemdescription;
    public $suppliername;
    public $supplier_id;
    
    public function rules()
    {
        return [
            [['purchase_order_details_id', 'purchase_order_id', 'bids_details_id', 'purchase_request_details_status', 'delivered'], 'integer'],
            [['purchaseordernumber', 'itemdescription','suppliername','supplier_id'], 'safe'],
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
        $query = Purchaseorderdetails::find();

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

        $query->joinWith('purchaseorder',false,'INNER JOIN');
        //$query->joinWith('bidsdetails',false,'INNER JOIN');
        $query->joinWith('bidsdetails.bid.supplier',false,'INNER JOIN');
        //$query->joinWith('bidsdetails.purchaserequestdetail',false,'INNER JOIN');
        $query->where(['tbl_purchase_order_details.purchase_request_details_status' => 1]);
        $query->orderBy(['purchase_order_id' => SORT_DESC]);
        // grid filtering conditions
        $query->andFilterWhere(['like', 'tbl_purchase_order.purchase_order_number', $this->purchaseordernumber]);
        $query->andFilterWhere(['like', 'tbl_bids_details.bids_item_description', $this->itemdescription]);
        $query->andFilterWhere(['like', 'tbl_supplier.supplier_name', $this->suppliername]);

        return $dataProvider;
    }
}
