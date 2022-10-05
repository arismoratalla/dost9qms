<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Ppmp;

/**
 * PpmpSearch represents the model behind the search form about `common\models\procurement\Ppmp`.
 */
class PpmpSearch extends Ppmp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ppmp_id', 'division_id', 'charged_to', 'project_id', 'year', 'end_user_id', 'head_id'], 'integer'],
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
        $query = Ppmp::find();

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
            'ppmp_id' => $this->ppmp_id,
            'division_id' => $this->division_id,
            'charged_to' => $this->charged_to,
            'project_id' => $this->project_id,
            'year' => $this->year,
            'end_user_id' => $this->end_user_id,
            'head_id' => $this->head_id,
        ]);

        return $dataProvider;
    }
}
