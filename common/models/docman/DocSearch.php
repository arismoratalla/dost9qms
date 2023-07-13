<?php

namespace common\models\docman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\docman\Doc;

/**
 * DocSearch represents the model behind the search form about `common\models\docman\Doc`.
 */
class DocSearch extends Doc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id', 'subcategory_id', 'functional_unit_id', 'status_id'], 'integer'],
            [['code', 'name', 'file'], 'safe'],
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
        $query = Doc::find();

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
            'doc_id' => $this->doc_id,
            'subcategory_id' => $this->subcategory_id,
            'functional_unit_id' => $this->functional_unit_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
