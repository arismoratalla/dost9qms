<?php

namespace common\models\budget;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\budget\Allocationadjustment;

/**
 * AllocationadjustmentSearch represents the model behind the search form about `common\models\budget\Allocationadjustment`.
 */
class AllocationadjustmentSearch extends Allocationadjustment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['allocation_adjustment_id', 'item_id', 'item_detail_id', 'source_item', 'created_by'], 'integer'],
            [['amount'], 'number'],
            [['create_date'], 'safe'],
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
    public function search($params, $itemid)
    {
        $query = Allocationadjustment::find()->where(['item_id'=>$itemid]);

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
            'allocation_adjustment_id' => $this->allocation_adjustment_id,
            'item_id' => $this->item_id,
            'item_detail_id' => $this->item_detail_id,
            'source_item' => $this->source_item,
            'amount' => $this->amount,
            'create_date' => $this->create_date,
            'created_by' => $this->created_by,
        ]);
        
        $query->andFilterWhere(['<>', 'item_id', $this->item_id])
            ->andFilterWhere(['<>', 'item_detail_id', $this->item_detail_id]);

        return $dataProvider;
    }
}
