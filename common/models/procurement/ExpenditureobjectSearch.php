<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Expenditureobject;

/**
 * ExpenditureobjectSearch represents the model behind the search form about `common\models\procurement\Expenditureobject`.
 */
class ExpenditureobjectSearch extends Expenditureobject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expenditure_object_id', 'expenditure_sub_class_id', 'object_code'], 'integer'],
            [['name'], 'safe'],
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
        $query = Expenditureobject::find();

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
            'expenditure_object_id' => $this->expenditure_object_id,
            'expenditure_sub_class_id' => $this->expenditure_sub_class_id,
            //'object_code' => $this->object_code,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'object_code', $this->object_code]);
        $query->andFilterWhere(['like', 'account_code', $this->account_code]);

        return $dataProvider;
    }
}
