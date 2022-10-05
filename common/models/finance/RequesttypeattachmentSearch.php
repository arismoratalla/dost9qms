<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Requesttypeattachment;

/**
 * RequesttypeattachmentSearch represents the model behind the search form about `common\models\finance\Requesttypeattachment`.
 */
class RequesttypeattachmentSearch extends Requesttypeattachment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_type_attachment_id', 'request_type_id', 'attachment_id'], 'integer'],
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
        $query = Requesttypeattachment::find();

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
            'request_type_attachment_id' => $this->request_type_attachment_id,
            'request_type_id' => $this->request_type_id,
            'attachment_id' => $this->attachment_id,
        ]);

        return $dataProvider;
    }
}
