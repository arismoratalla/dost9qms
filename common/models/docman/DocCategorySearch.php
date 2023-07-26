<?php

namespace common\models\docman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\docman\Doc;

/**
 * DocSearch represents the model behind the search form about `common\models\docman\Doc`.
 */
class DocCategorySearch extends Doc
{
    public $doccategory_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id', 'section_id', 'revision_num', 'status_id'], 'integer'],
            [['code', 'name', 'effectivity_date', 'person_responsible', 'copy_holder'], 'safe'],
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

        $query->joinWith(['section.doccategory as category']);

        // grid filtering conditions
        $query->andFilterWhere([
            'doc_id' => $this->doc_id,
            'tbl_doc.section_id' => $this->section_id,
            'effectivity_date' => $this->effectivity_date,
            'revision_num' => $this->revision_num,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'tbl_doc.name', $this->name])
            ->andFilterWhere(['like', 'person_responsible', $this->person_responsible])
            ->andFilterWhere(['like', 'copy_holder', $this->copy_holder]);

        $query->andFilterWhere(['like', 'category.doccategory_id', $this->doccategory_id]);

        return $dataProvider;
    }
}
