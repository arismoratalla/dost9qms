<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Purchaserequest;

/**
 * PurchaserequestSearch represents the model behind the search form about `common\models\procurement\Purchaserequest`.
 */
class PurchaserequestSearch extends Purchaserequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_request_id', 'division_id', 'section_id', 'purchase_request_requestedby_id', 'purchase_request_approvedby_id'], 'integer'],
            [['purchase_request_number', 'purchase_request_sai_number', 'purchase_request_date', 'purchase_request_saidate', 'purchase_request_purpose', 'purchase_request_referrence_no', 'purchase_request_project_name', 'purchase_request_location_project'], 'safe'],
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
        $query = Purchaserequest::find();

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
            'purchase_request_id' => $this->purchase_request_id,
            'division_id' => $this->division_id,
            'section_id' => $this->section_id,
            'purchase_request_date' => $this->purchase_request_date,
            'purchase_request_saidate' => $this->purchase_request_saidate,
            'purchase_request_requestedby_id' => $this->purchase_request_requestedby_id,
            'purchase_request_approvedby_id' => $this->purchase_request_approvedby_id,
        ]);

        $query->andFilterWhere(['like', 'purchase_request_number', $this->purchase_request_number])
            ->andFilterWhere(['like', 'purchase_request_sai_number', $this->purchase_request_sai_number])
            ->andFilterWhere(['like', 'purchase_request_purpose', $this->purchase_request_purpose])
            ->andFilterWhere(['like', 'purchase_request_referrence_no', $this->purchase_request_referrence_no])
            ->andFilterWhere(['like', 'purchase_request_project_name', $this->purchase_request_project_name])
            ->andFilterWhere(['like', 'purchase_request_location_project', $this->purchase_request_location_project]);

        return $dataProvider;
    }
}
