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
            'sort'=> ['defaultOrder' => ['document_code'=>SORT_ASC]]
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
        

        if( !(Yii::$app->user->can('17025-auditor') || Yii::$app->user->can('17025-document-custodian') || (Yii::$app->user->identity->username == 'Admin') ) ){
            if(isset($_GET['category_id'])){
                $query->andFilterWhere(['in', 'category_id', [1,2,3,5,6,7,8,9,10,12,13,14,15,16,17,18,19,20,21,22,23,24]]);
            }
            if(isset($_GET['functional_unit_id'])){
            // $query->andFilterWhere(['in', 'functional_unit_id', $groups]);
            // $query->andFilterWhere(['=', 'functional_unit_id', Yii::$app->user->identity->profile->unit_id]);
            $query->andFilterWhere(['in', 'functional_unit_id', explode(',', Yii::$app->user->identity->profile->groups)]);
            }
        }

        if( (Yii::$app->user->can('17025-auditor') ) ){
            if(isset($_GET['functional_unit_id'])){
                // $query->andFilterWhere(['=', 'functional_unit_id', $this->functional_unit_id]);
                // $query->andFilterWhere(['=', 'functional_unit_id', Yii::$app->user->identity->profile->unit_id]);
                $query->andFilterWhere(['in', 'functional_unit_id', explode(',', Yii::$app->user->identity->profile->groups)]);
            }
        }

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'document_code', $this->document_code])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
