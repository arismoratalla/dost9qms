<?php

namespace common\models\procurementplan;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurementplan\Item;


/**
 * ItemSearch represents the model behind the search form about `common\models\procurementplan\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public $selectMonth;

    public function rules()
    {
        return [
            [['item_id', 'item_category_id', 'unit_of_measure_id'], 'integer'],
            [['item_name', 'last_update','product_code','supply_type'], 'safe'],
            [['price_catalogue'], 'number'],
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
        $query = Item::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'availability' => SORT_ASC,
                    'item_category_id' => SORT_ASC,
                    'item_name' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'item_id' => $this->item_id,
            'supply_type' => $this->supply_type,
            'item_category_id' => $this->item_category_id,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'price_catalogue' => $this->price_catalogue,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name]);
        $query->andFilterWhere(['like', 'product_code', $this->product_code,]);

        return $dataProvider;
    }

}
