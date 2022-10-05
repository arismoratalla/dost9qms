<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Requestattachment;

/**
 * RequestattachmentSearch represents the model behind the search form about `common\models\finance\Requestattachment`.
 */
class RequestattachmentSearch extends Requestattachment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_attachment_id', 'request_id', 'name', 'attachment_type_id'], 'integer'],
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
        $query = Requestattachment::find();

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
            'request_attachment_id' => $this->request_attachment_id,
            'request_id' => $this->request_id,
            'name' => $this->name,
            'attachment_type_id' => $this->attachment_type_id,
        ]);

        return $dataProvider;
    }
}
