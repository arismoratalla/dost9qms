<?php

namespace common\models\docman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\docman\Document;

/**
 * DocumentSearch represents the model behind the search form about `common\models\docman\Document`.
 */
class DocumentSearch extends Document
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'category_id', 'functional_unit_id', 'revision_number', 'user_id', 'active'], 'integer'],
            [['subject', 'filename', 'document_code', 'content', 'effectivity_date'], 'safe'],
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
        $query = Document::find();

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
            'document_id' => $this->document_id,
            'qms_type_id' => $this->qms_type_id,
            'category_id' => $this->category_id,
            'functional_unit_id' => $this->functional_unit_id,
            'revision_number' => $this->revision_number,
            'effectivity_date' => $this->effectivity_date,
            'user_id' => $this->user_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'document_code', $this->document_code])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
