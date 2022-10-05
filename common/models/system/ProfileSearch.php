<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\Profile;

/**
 * ProfileSearch represents the model behind the search form about `common\models\Profile`.
 */
class ProfileSearch extends Profile
{
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'division_id', 'unit_id'], 'integer'],
            [['lastname', 'firstname', 'middleinitial','designation','contact_numbers'], 'safe'],
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
        $query = Profile::find();

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
            'user_id' => $this->user_id,
            'division_id' => $this->division_id,
            'unit_id' => $this->unit_id,
        ]);
        if(Yii::$app->user->can('access-his-profile')){
            $query->andFilterWhere([
                'user_id' => Yii::$app->user->identity->user_id,
            ]);
        }
        $query->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like','user.username', $this->username])
            ->andFilterWhere(['like','designation', $this->designation])
            ->andFilterWhere(['like','contact_numbers', $this->contact_numbers])
            ->andFilterWhere(['like', 'middleinitial', $this->middleinitial]);

        return $dataProvider;
    }
}
