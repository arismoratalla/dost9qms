<?php

namespace common\models\cashier;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\cashier\Lddapada;

/**
 * LddapadaSearch represents the model behind the search form about `common\models\cashier\Lddapada`.
 */
class LddapadaSearch extends Lddapada
{
//    public $payee_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lddapada_id', 'certified_correct_id', 'approved_id', 'validated1_id', 'validated2_id'], 'integer'],
            [['batch_number', 'batch_date', 'created_by'], 'safe'],
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
        
        $query = Lddapada::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'batch_date' => SORT_DESC,
                    'batch_number' => SORT_DESC,
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
            'lddapada_id' => $this->lddapada_id,
            'batch_date' => $this->batch_date,
            'certified_correct_id' => $this->certified_correct_id,
            'approved_id' => $this->approved_id,
            'validated1_id' => $this->validated1_id,
            'validated2_id' => $this->validated2_id,
        ]);
        
//        $query->andFilterWhere(['like', 'tbl_creditor.lddapadaItems.payee_id', 3]);
//        $query->andFilterWhere(['like', 'batch_number', $this->batch_number])
//            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
