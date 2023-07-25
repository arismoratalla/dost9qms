<?php

namespace common\models\docman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\docman\Docattachment;

/**
 * DocattachmentSearch represents the model behind the search form about `common\models\docman\Docattachment`.
 */
class DocattachmentSearch extends Docattachment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_attachment_id', 'doc_id', 'document_type'], 'integer'],
            [['filename', 'last_update'], 'safe'],
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
        $query = Docattachment::find();

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
            'doc_attachment_id' => $this->doc_attachment_id,
            'doc_id' => $this->doc_id,
            'document_type' => $this->document_type,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }
}
