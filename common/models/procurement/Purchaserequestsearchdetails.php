<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\PurchaseRequestDetails;

/**
 * PurchaserequestSearchDetails represents the model behind the search form about `common\models\procurement\PurchaseRequestDetails`.
 */
class Purchaserequestsearchdetails extends PurchaseRequestDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_request_details_id', 'purchase_request_id', 'purchase_request_details_unit', 'unit_id', 'purchase_request_details_quantity', 'purchase_request_details_status'], 'integer'],
            [['purchase_request_details_item_description', 'item_description'], 'safe'],
            [['purchase_request_details_price'], 'number'],
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
        $query = PurchaseRequestDetails::find();

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
            'purchase_request_details_id' => $this->purchase_request_details_id,
            'purchase_request_id' => $this->purchase_request_id,
            'purchase_request_details_unit' => $this->purchase_request_details_unit,
            'unit_id' => $this->unit_id,
            'purchase_request_details_quantity' => $this->purchase_request_details_quantity,
            'purchase_request_details_price' => $this->purchase_request_details_price,
            'purchase_request_details_status' => $this->purchase_request_details_status,
        ]);

        $query->andFilterWhere(['like', 'purchase_request_details_item_description', $this->purchase_request_details_item_description])
            ->andFilterWhere(['like', 'item_description', $this->item_description]);

        return $dataProvider;
    }
}
