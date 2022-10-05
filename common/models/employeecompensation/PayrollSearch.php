<?php

namespace common\models\employeecompensation;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\employeecompensation\Payroll;

/**
 * PayrollSearch represents the model behind the search form about `common\models\employeecompensation\Payroll`.
 */
class PayrollSearch extends Payroll
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payroll_id', 'obligation_type_id', 'created_by'], 'integer'],
            [['payroll_date'], 'safe'],
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
        $query = Payroll::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['payroll_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'payroll_id' => $this->payroll_id,
            'obligation_type_id' => $this->obligation_type_id,
            'payroll_date' => $this->payroll_date,
            'created_by' => $this->created_by,
        ]);

        return $dataProvider;
    }
}
