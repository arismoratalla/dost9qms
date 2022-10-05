<?php

namespace common\models\employeecompensation;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\employeecompensation\Payrollitem;

/**
 * PayrollitemSearch represents the model behind the search form about `common\models\employeecompensation\Payrollitem`.
 */
class PayrollitemSearch extends Payrollitem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payroll_item_id', 'payroll_id', 'creditor_id'], 'integer'],
            [['salary', 'gross_amount_earned'], 'number'],
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
        $query = Payrollitem::find();

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
            'payroll_item_id' => $this->payroll_item_id,
            'payroll_id' => $this->payroll_id,
            'creditor_id' => $this->creditor_id,
            'salary' => $this->salary,
            'gross_amount_earned' => $this->gross_amount_earned,
        ]);

        return $dataProvider;
    }
}
