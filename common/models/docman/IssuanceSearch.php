<?php

namespace common\models\docman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\docman\Issuance;

/**
 * IssuanceSearch represents the model behind the search form about `common\models\docman\Issuance`.
 */
class IssuanceSearch extends Issuance
{
    public $year;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['issuance_id', 'issuance_type_id'], 'integer'],
            [['code', 'subject', 'file', 'date'], 'safe'],
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
        $query = Issuance::find();

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
            'issuance_id' => $this->issuance_id,
            'issuance_type_id' => $this->issuance_type_id,
        ]);

        // If year attribute is set, filter by that year
        if ($this->year) {
            $query->andFilterWhere(['>=', 'date', $this->year . '-01-01'])
                  ->andFilterWhere(['<=', 'date', $this->year . '-12-31']);
        } else {
            $query->andFilterWhere(['date' => $this->date]);
        }

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
