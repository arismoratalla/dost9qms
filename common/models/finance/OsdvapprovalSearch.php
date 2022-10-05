<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Osdv;


/**
 * OsdvSearch represents the model behind the search form about `common\models\finance\Osdv`.
 */
class OsdvapprovalSearch extends Osdv
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['osdv_id', 'request_id', 'type_id', 'expenditure_class_id', 'status_id', 'created_by'], 'integer'],
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
        $query = Osdv::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['osdv_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'request_id' => $this->request_id,
            'type_id' => $this->type_id,
            'expenditure_class_id' => $this->expenditure_class_id,
            //'status_id' => $this->status_id,
            'created_by' => $this->created_by,
            'cancelled' => 0,
        ]);
        //$query->andFilterWhere(['=', 'status_id', 67]);
        $query->andFilterWhere(['>=', 'status_id', 65]);
        $query->andFilterWhere(['<', 'status_id', 70]);

        return $dataProvider;
    }
}
