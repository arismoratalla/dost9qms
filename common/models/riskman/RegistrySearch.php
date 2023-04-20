<?php

namespace common\models\riskman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\riskman\Registry;

/**
 * RegistrySearch represents the model behind the search form about `common\models\riskman\Registry`.
 */
class RegistrySearch extends Registry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_id', 'unit_id', 'area_id'], 'integer'],
            [['registry_type', 'code', 'stakeholders', 'customer_requirement', 'create_date'], 'safe'],
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
        $query = Registry::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'registry_id' => $this->registry_id,
            'unit_id' => $this->unit_id,
            'area_id' => $this->area_id,
            'create_date' => $this->create_date,
            'active' => 1,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'registry_type', $this->registry_type])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'stakeholders', $this->stakeholders])
            ->andFilterWhere(['like', 'customer_requirement', $this->customer_requirement]);

            // if( (Yii::$app->user->can('riskman-manager') || Yii::$app->user->can('riskman-member') ) ){
            //     $query->andFilterWhere(['in', 'unit_id', explode(',', Yii::$app->user->identity->profile->groups)]);
            // }
        

        return $dataProvider;
    }
}
