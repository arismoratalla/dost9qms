<?php

namespace common\models\riskman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\riskman\Registryaction;

/**
 * RegistryactionSearch represents the model behind the search form about `common\models\riskman\Registryaction`.
 */
class RegistryactionSearch extends Registryaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_action_id', 'registry_id'], 'integer'],
            [['preventive_control_initiatives', 'corrective_additional_action', 'target_date_of_completion'], 'safe'],
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
        $query = Registryaction::find();

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
            'registry_action_id' => $this->registry_action_id,
            'registry_id' => $this->registry_id,
            'target_date_of_completion' => $this->target_date_of_completion,
        ]);

        $query->andFilterWhere(['like', 'preventive_control_initiatives', $this->preventive_control_initiatives])
            ->andFilterWhere(['like', 'corrective_additional_action', $this->corrective_additional_action]);

        return $dataProvider;
    }
}
