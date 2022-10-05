<?php

namespace common\models\budget;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\budget\Obligation;

/**
 * ObligationSearch represents the model behind the search form about `common\models\budget\Obligation`.
 */
class ObligationSearch extends Obligation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['obligation_id', 'financial_request_id'], 'integer'],
            [['obligation_number', 'obligation_date'], 'safe'],
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
        $query = Obligation::find();

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
            'obligation_id' => $this->obligation_id,
            'financial_request_id' => $this->financial_request_id,
            'obligation_date' => $this->obligation_date,
        ]);

        $query->andFilterWhere(['like', 'obligation_number', $this->obligation_number]);

        return $dataProvider;
    }
}
