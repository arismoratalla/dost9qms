<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\Notification;

/**
 * NotificationSearch represents the model behind the search form about `common\models\system\Notification`.
 */
class NotificationSearch extends Notification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_id', 'sender', 'recipient', 'status'], 'integer'],
            [['hash', 'title', 'message', 'via', 'created_at', 'module', 'action'], 'safe'],
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
        $query = Notification::find();

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
            'notification_id' => $this->notification_id,
            'sender' => $this->sender,
            'recipient' => $this->recipient,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'hash', $this->hash])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'via', $this->via])
            ->andFilterWhere(['like', 'module', $this->module])
            ->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }
}
