<?php

namespace common\models\docman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\docman\Functionalunit;
use common\models\system\User;

/**
 * FunctionalunitSearch represents the model behind the search form about `common\models\docman\Functionalunit`.
 */
class FunctionalunitSearch extends Functionalunit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['functional_unit_id', 'division_id', 'qms_type_id', 'unit_head', 'num'], 'integer'],
            [['name', 'code'], 'safe'],
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
        $query = Functionalunit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort'=> ['defaultOrder' => ['division_id'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['unithead as user']);

        // grid filtering conditions
        $query->andFilterWhere([
            'functional_unit_id' => $this->functional_unit_id,
            'division_id' => $this->division_id,
            'qms_type_id' => $this->qms_type_id,
            'unit_head' => $this->unit_head,
            'num' => $this->num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);
            // ->andFilterWhere(['like', 'user.status', 10]);

            // $query->andFilterWhere(['in', 'registry.unit_id', explode(',', Yii::$app->user->identity->profile->groups)]);

        return $dataProvider;
    }
}
