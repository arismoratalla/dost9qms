<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Expendituresubclass;

/**
 * ExpendituresubclassSearch represents the model behind the search form about `common\models\procurement\Expendituresubclass`.
 */
class ExpendituresubclassSearch extends Expendituresubclass
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expenditure_sub_class_id', 'expenditure_class_id'], 'integer'],
            [['name', 'class_code'], 'safe'],
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
        $query = Expendituresubclass::find();

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
            'expenditure_sub_class_id' => $this->expenditure_sub_class_id,
            'expenditure_class_id' => $this->expenditure_class_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'class_code', $this->class_code]);

        return $dataProvider;
    }
}
