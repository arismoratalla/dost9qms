<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Registration;

/**
 * RegistrationSearch represents the model behind the search form about `common\models\procurement\Registration`.
 */
class RegistrationSearch extends Registration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'checked_in'], 'integer'],
            [['name', 'student_num'], 'safe'],
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
        $query = Registration::find()
                ->orderBy([
                    'name'=> SORT_ASC,
                ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => false,
        ]);
        $dataProvider->pagination->pageSize = 5;
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'checked_in' => $this->checked_in,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'student_num', $this->student_num]);
        
        //$dataProvider->pagination->pageSize=5;
        return $dataProvider;
    }
}
