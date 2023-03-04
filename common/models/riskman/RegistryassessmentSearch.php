<?php

namespace common\models\riskman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\riskman\Registryassessment;

/**
 * RegistryassessmentSearch represents the model behind the search form about `common\models\riskman\Registryassessment`.
 */
class RegistryassessmentSearch extends Registryassessment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_assessment_id', 'registry_id', 'likelihood_id', 'benefit_consequence_id', 'evaluation', 'cause', 'effect','qtr', 'year'], 'integer'],
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
        $query = Registryassessment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['registry_id'=>SORT_DESC, 'year'=>SORT_DESC, 'qtr'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['registry as registry']);

        // grid filtering conditions
        $query->andFilterWhere([
            'registry_assessment_id' => $this->registry_assessment_id,
            'registry_id' => $this->registry_id,
            'likelihood_id' => $this->likelihood_id,
            'benefit_consequence_id' => $this->benefit_consequence_id,
            'evaluation' => $this->evaluation,
            'cause' => $this->cause,
            'effect' => $this->effect,
            'qtr' => $this->qtr,
            'year' => $this->year,
        ]);

        $query->andFilterWhere(['in', 'registry.unit_id', explode(',', Yii::$app->user->identity->profile->groups)]);

        return $dataProvider;
    }
}
