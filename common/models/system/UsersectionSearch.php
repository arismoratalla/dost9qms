<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\Usersection;

/**
 * UsersectionSearch represents the model behind the search form about `common\models\system\Usersection`.
 */
class UsersectionSearch extends Usersection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_section_id', 'user_id', 'section_id', 'access'], 'integer'],
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
        $query = Usersection::find();

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
            'user_section_id' => $this->user_section_id,
            'user_id' => $this->user_id,
            'section_id' => $this->section_id,
            'access' => $this->access,
        ]);

        return $dataProvider;
    }
}
