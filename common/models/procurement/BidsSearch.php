<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Bids;

/**
 * BidsSearch represents the model behind the search form about `common\models\procurement\Bids`.
 */
class BidsSearch extends Bids
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bids_id', 'supplier_id', 'purchase_request_id', 'bids_status'], 'integer'],
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
        $query = Bids::find();

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
            'bids_id' => $this->bids_id,
            'supplier_id' => $this->supplier_id,
            'purchase_request_id' => $this->purchase_request_id,
            'bids_status' => $this->bids_status,
        ]);

        return $dataProvider;
    }

}
