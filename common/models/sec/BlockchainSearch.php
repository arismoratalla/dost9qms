<?php

namespace common\models\sec;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\sec\Blockchain;

/**
 * BlockchainSearch represents the model behind the search form about `common\models\sec\Blockchain`.
 */
class BlockchainSearch extends Blockchain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockchain_id', 'index_id', 'timestamp', 'nonce', 'user_id'], 'integer'],
            [['scope', 'data', 'previoushash', 'hash'], 'safe'],
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
        $query = Blockchain::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['timestamp'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'blockchain_id' => $this->blockchain_id,
            'index_id' => $this->index_id,
            'timestamp' => $this->timestamp,
            'nonce' => $this->nonce,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'scope', $this->scope])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'previoushash', $this->previoushash])
            ->andFilterWhere(['like', 'hash', $this->hash]);
        
        //$query->andFilterWhere(['like', 'scope', $this->request->request_number]);

        return $dataProvider;
    }
}
