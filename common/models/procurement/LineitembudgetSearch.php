<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Lineitembudget;

/**
 * LineitembudgetSearch represents the model behind the search form about `common\models\procurement\Lineitembudget`.
 */
class LineitembudgetSearch extends Lineitembudget
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['line_item_budget_id', 'type_id', 'subtype_id', 'division_id', 'section_id', 'project_id', 'program_id'], 'integer'],
            [['title', 'period', 'duration_start', 'duration_end'], 'safe'],
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
        $query = Lineitembudget::find();

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
            'line_item_budget_id' => $this->line_item_budget_id,
            'type_id' => $this->type_id,
            'subtype_id' => $this->subtype_id,
            'duration_start' => $this->duration_start,
            'duration_end' => $this->duration_end,
            'division_id' => $this->division_id,
            'section_id' => $this->section_id,
            'project_id' => $this->project_id,
            'program_id' => $this->program_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'period', $this->period]);

        return $dataProvider;
    }
}
