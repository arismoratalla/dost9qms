<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Assignatory;

/**
 * AssignatorySearch represents the model behind the search form about `common\models\procurement\Assignatory`.
 */
class AssignatorySearch extends Assignatory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assignatory_id', 'assignatory_1', 'assignatory_2', 'assignatory_3', 'assignatory_4', 'assignatory_5', 'assignatory_6'], 'integer'],
            [['CompanyTitle', 'RegionOffice', 'Address', 'report_title'], 'safe'],
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
        $query = Assignatory::find();

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
            'assignatory_id' =>$this->assignatory_id,
            'assignatory_1' => $this->assignatory_1,
            'assignatory_2' => $this->assignatory_2,
            'assignatory_3' => $this->assignatory_3,
            'assignatory_4' => $this->assignatory_4,
            'assignatory_5' => $this->assignatory_5,
            'assignatory_6' => $this->assignatory_6,
        ]);

        $query->andFilterWhere(['like', 'CompanyTitle', $this->CompanyTitle])
            ->andFilterWhere(['like', 'RegionOffice', $this->RegionOffice])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'report_title', $this->report_title]);

        return $dataProvider;
    }
}
