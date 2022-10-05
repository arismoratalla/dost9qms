<?php

namespace common\models\procurementplan;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurementplan\Ppmpitem;

/**
 * AppSearch represents the model behind the search form about `common\models\procurementplan\Ppmpitem`.
 */
class AppSearch extends Ppmpitem
{
    /**
     * @inheritdoc
     */
    public $selectyear;

    public function rules()
    {
        return [
            [['ppmp_item_id', 'ppmp_id', 'item_id', 'item_category_id', 'ppmp_item_category_id', 'quantity', 'unit', 'mode_of_procurement', 'availability', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'q12', 'month', 'active', 'status_id', 'supplemental', 'create_user', 'update_user', 'submitted_user', 'approved_user'], 'integer'],
            [['code','selectyear', 'description', 'item_specification', 'create_date', 'update_date', 'submitted_date', 'approved_date'], 'safe'],
            [['cost', 'estimated_budget'], 'number'],
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
    public function __search($params)
    {
        $query = Ppmpitem::find();

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
            'ppmp_item_id' => $this->ppmp_item_id,
            'ppmp_id' => $this->ppmp_id,
            'item_id' => $this->item_id,
            'item_category_id' => $this->item_category_id,
            'ppmp_item_category_id' => $this->ppmp_item_category_id,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'cost' => $this->cost,
            'estimated_budget' => $this->estimated_budget,
            'mode_of_procurement' => $this->mode_of_procurement,
            'availability' => $this->availability,
            'q1' => $this->q1,
            'q2' => $this->q2,
            'q3' => $this->q3,
            'q4' => $this->q4,
            'q5' => $this->q5,
            'q6' => $this->q6,
            'q7' => $this->q7,
            'q8' => $this->q8,
            'q9' => $this->q9,
            'q10' => $this->q10,
            'q11' => $this->q11,
            'q12' => $this->q12,
            'month' => $this->month,
            'active' => $this->active,
            'status_id' => $this->status_id,
            'supplemental' => $this->supplemental,
            'create_user' => $this->create_user,
            'create_date' => $this->create_date,
            'update_user' => $this->update_user,
            'update_date' => $this->update_date,
            'submitted_user' => $this->submitted_user,
            'submitted_date' => $this->submitted_date,
            'approved_user' => $this->approved_user,
            'approved_date' => $this->approved_date,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'item_specification', $this->item_specification]);

        return $dataProvider;
    }
    public function search($params)
    {
         $query = Ppmpitem::find()->select([
            'ppmp_item_id' => 'tbl_ppmp_item.ppmp_item_id',
            'ppmp_id' => 'tbl_ppmp_item.ppmp_id',
            'item_id' => 'tbl_ppmp_item.item_id',
            'item_category_id' => 'tbl_ppmp_item.item_category_id',
            'ppmp_item_category_id' => 'tbl_ppmp_item.ppmp_item_category_id',
            'code' => 'tbl_ppmp_item.code',
            'description' => 'tbl_ppmp_item.description',
            'item_specification' => 'tbl_ppmp_item.item_specification',
            'quantity' => '(sum(tbl_ppmp_item.q1) + sum(tbl_ppmp_item.q2) + sum(tbl_ppmp_item.q3) + sum(tbl_ppmp_item.q4) + sum(tbl_ppmp_item.q5) + sum(tbl_ppmp_item.q6) + sum(tbl_ppmp_item.q7) + sum(tbl_ppmp_item.q8) + sum(tbl_ppmp_item.q9) + sum(tbl_ppmp_item.q10) + sum(tbl_ppmp_item.q11) + sum(tbl_ppmp_item.q12))',
            'unit' => 'tbl_ppmp_item.unit',
            'cost' => 'tbl_ppmp_item.cost',
            'estimated_budget' => 'tbl_ppmp_item.estimated_budget',
            'mode_of_procurement' => 'tbl_ppmp_item.mode_of_procurement',
            'availability' => 'tbl_ppmp_item.availability',
            'jan' => 'sum(tbl_ppmp_item.q1)',
            'feb' => 'sum(tbl_ppmp_item.q2)',
            'mar' => 'sum(tbl_ppmp_item.q3)',
            'q1' => '(sum(tbl_ppmp_item.q1) + sum(tbl_ppmp_item.q2) + sum(tbl_ppmp_item.q3))',
            'q1amount' => '(sum(tbl_ppmp_item.q1) + sum(tbl_ppmp_item.q2) + sum(tbl_ppmp_item.q3)) * tbl_ppmp_item.cost',
            'apr' => 'sum(tbl_ppmp_item.q4)',
            'may' => 'sum(tbl_ppmp_item.q5)',
            'jun' => 'sum(tbl_ppmp_item.q6)',
            'q2' => '(sum(tbl_ppmp_item.q4) + sum(tbl_ppmp_item.q5) + sum(tbl_ppmp_item.q6))',
            'q2amount' => '(sum(tbl_ppmp_item.q4) + sum(tbl_ppmp_item.q5) + sum(tbl_ppmp_item.q6)) * tbl_ppmp_item.cost',
            'jul' => 'sum(tbl_ppmp_item.q7)',
            'aug' => 'sum(tbl_ppmp_item.q8)',
            'sep' => 'sum(tbl_ppmp_item.q9)',
            'q3' => '(sum(tbl_ppmp_item.q7) + sum(tbl_ppmp_item.q8) + sum(tbl_ppmp_item.q9))',
            'q3amount' => '(sum(tbl_ppmp_item.q7) + sum(tbl_ppmp_item.q8) + sum(tbl_ppmp_item.q9)) * tbl_ppmp_item.cost',
            'oct' => 'sum(tbl_ppmp_item.q10)',
            'nov' => 'sum(tbl_ppmp_item.q11)',
            'dec' => 'sum(tbl_ppmp_item.q12)',
            'q4' => '(sum(tbl_ppmp_item.q10) + sum(tbl_ppmp_item.q11) + sum(tbl_ppmp_item.q12))',
            'q4amount' => '(sum(tbl_ppmp_item.q10) + sum(tbl_ppmp_item.q11) + sum(tbl_ppmp_item.q12)) * tbl_ppmp_item.cost',
            'month' => 'tbl_ppmp_item.month',
            'active' => 'tbl_ppmp_item.active',
            'status_id' => 'tbl_ppmp_item.status_id',
            'supplemental' => 'tbl_ppmp_item.supplemental',
            //'year' => 'tbl_ppmp.year',
            'totalamount' => '(sum(tbl_ppmp_item.q1) + sum(tbl_ppmp_item.q2) + sum(tbl_ppmp_item.q3) + sum(tbl_ppmp_item.q4) + sum(tbl_ppmp_item.q5) + sum(tbl_ppmp_item.q6) + sum(tbl_ppmp_item.q7) + sum(tbl_ppmp_item.q8) + sum(tbl_ppmp_item.q9) + sum(tbl_ppmp_item.q10) + sum(tbl_ppmp_item.q11) + sum(tbl_ppmp_item.q12)) * cost'

        ])
                         
                            ->groupBy([
                                    'tbl_ppmp_item.item_id',])
                            ->joinWith('ppmp');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'availability' => SORT_ASC,
                    'item_category_id' => SORT_ASC,
                    //'title' => SORT_ASC, 
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
       $query->where([
            'tbl_ppmp_item.active' => 1,
            'tbl_ppmp_item.status_id' => 2,
            'tbl_ppmp.year' => $this->selectyear,
        ]);

        return $dataProvider;
    }
}
