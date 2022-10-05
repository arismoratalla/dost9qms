<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Bidsdetails;
use yii\db\Query;

/**
 * BidsDetailSearch represents the model behind the search form about `common\models\procurement\BidsDetails`.
 */
class BidsdetailSearch extends Bidsdetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bids_details_id', 'purchase_request_id', 'bids_id', 'bids_quantity', 'bids_details_status'], 'integer'],
            [['bids_unit', 'bids_item_description'], 'safe'],
            [['bids_price'], 'number'],
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
        $query = Bidsdetails::find();
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
            'bids_details_id' => $this->bids_details_id,
            'purchase_request_id' => $this->purchase_request_id,
            'purchase_request_details_id' => $this->purchase_request_details_id,
            'bids_id' => $this->bids_id,
            'bids_quantity' => $this->bids_quantity,
            'bids_price' => $this->bids_price,
            'bids_details_status' => $this->bids_details_status,
            'bids_remarks' => $this->bids_remarks,
        ]);

        $query->andFilterWhere(['like', 'bids_unit', $this->bids_unit])
            ->andFilterWhere(['like', 'bids_item_description', $this->bids_item_description]);

        return $dataProvider;
    }
}
