<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Osallotment;

/**
 * OsallotmentSearch represents the model behind the search form about `common\models\finance\Osallotment`.
 */
class OsallotmentSearch extends Osallotment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['os_allotment_id', 'osdv_id', 'expenditure_class_id', 'expenditure_object_id'], 'integer'],
            [['amount'], 'number'],
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
        $query = Osallotment::find();

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
            'os_allotment_id' => $this->os_allotment_id,
            'osdv_id' => $this->osdv_id,
            'expenditure_class_id' => $this->expenditure_class_id,
            'expenditure_object_id' => $this->expenditure_object_id,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
