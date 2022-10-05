<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Purchaseorder;

/**
 * PurchaseorderSearch represents the model behind the search form about `common\models\procurement\Purchaseorder`.
 */
class PurchaseorderSearch extends Purchaseorder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_order_id', 'supplier_id', 'purchase_order_status'], 'integer'],
            [['purchase_order_number', 'purchase_order_date', 'place_of_delivery', 'date_of_delivery', 'delivery_term', 'payment_term', 'mode_of_procurement'], 'safe'],
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
        $query = Purchaseorder::find();

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
            'purchase_order_id' => $this->purchase_order_id,
            'supplier_id' => $this->supplier_id,
            'purchase_order_status' => $this->purchase_order_status,
            'purchase_order_date' => $this->purchase_order_date,
            'date_of_delivery' => $this->date_of_delivery,
        ]);

        $query->andFilterWhere(['like', 'purchase_order_number', $this->purchase_order_number])
            ->andFilterWhere(['like', 'place_of_delivery', $this->place_of_delivery])
            ->andFilterWhere(['like', 'delivery_term', $this->delivery_term])
            ->andFilterWhere(['like', 'payment_term', $this->payment_term])
            ->andFilterWhere(['like', 'mode_of_procurement', $this->mode_of_procurement]);

        return $dataProvider;
    }
}
