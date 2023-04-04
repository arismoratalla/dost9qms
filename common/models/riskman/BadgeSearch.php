<?php

namespace common\models\riskman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\riskman\Badge;

/**
 * BadgeSearch represents the model behind the search form about `common\models\riskman\Badge`.
 */
class BadgeSearch extends Badge
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['badge_id', 'module_id', 'description'], 'integer'],
            [['name', 'criteria', 'award_type', 'icon', 'date_created', 'date_modified'], 'safe'],
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
        $query = Badge::find();

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
            'badge_id' => $this->badge_id,
            // 'module_id' => Yii::$app->controller->module->id,
            'description' => $this->description,
            'date_created' => $this->date_created,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'module_id', Yii::$app->controller->module->id])
            ->andFilterWhere(['like', 'criteria', $this->criteria])
            ->andFilterWhere(['like', 'award_type', $this->award_type])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
