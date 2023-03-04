<?php

namespace common\models\riskman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\riskman\Registryevaluation;

/**
 * RegistryevaluationSearch represents the model behind the search form about `common\models\riskman\Registryevaluation`.
 */
class RegistryevaluationSearch extends Registryevaluation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_evaluation_id', 'registry_id', 'evaluation', 'year'], 'integer'],
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
        $query = Registryevaluation::find();

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
            'registry_evaluation_id' => $this->registry_evaluation_id,
            'registry_id' => $this->registry_id,
            'evaluation' => $this->evaluation,
            'year' => $this->year,
        ]);

        return $dataProvider;
    }
}
