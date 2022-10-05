<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\VwPurchaseRequest;

/**
 * PurchaserequestSearch represents the model behind the search form about `common\models\procurement\Purchaserequest`.
 */
class PurchaserequestSearch extends VwPurchaseRequest
{
    /**
     * @inheritdoc
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['purchase_request_id',  'purchase_request_requestedby_id', 'user_id'], 'integer'],
            [['purchase_request_number','globalSearch','division_name', 'section_name','purchase_request_purpose'], 'safe'],
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
        if(Yii::$app->user->can('access-pr-all-items')){
            $query = VwPurchaseRequest::find();
        }else{
            $query = VwPurchaseRequest::find()->where("user_id = '".yii::$app->user->getId()."' OR purchase_request_requestedby_id = '".yii::$app->user->getId()."'");
        }
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            //'sort' => ['attributes' => ['purchase_request_number']],
            'sort' => ['defaultOrder' => ['purchase_request_number' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        /*
        $query->andFilterWhere([
            'purchase_request_id' => $this->purchase_request_id,
            'division_id' => $this->division_id,
            'section_id' => $this->section_id,
            'purchase_request_date' => $this->purchase_request_date,
            'purchase_request_saidate' => $this->purchase_request_saidate,
            'purchase_request_requestedby_id' => $this->purchase_request_requestedby_id,
            'purchase_request_approvedby_id' => $this->purchase_request_approvedby_id,
            'user_id' => $this->user_id,
        ]);*/

        $query->orFilterWhere(['like', 'purchase_request_number', $this->globalSearch])
              ->orFilterWhere(['like', 'purchase_request_purpose', $this->globalSearch])
              ->orFilterWhere(['like', 'requested_by', $this->globalSearch])
              ->orFilterWhere(['like', 'po_number', $this->globalSearch]);
            //->andFilterWhere(['like', 'purchase_request_sai_number', $this->purchase_request_sai_number])
            //->andFilterWhere(['like', 'purchase_request_purpose', $this->purchase_request_purpose])
            //->andFilterWhere(['like', 'purchase_request_referrence_no', $this->purchase_request_referrence_no])
            //->andFilterWhere(['like', 'purchase_request_project_name', $this->purchase_request_project_name])
            //->andFilterWhere(['like', 'purchase_request_location_project', $this->purchase_request_location_project]);

        return $dataProvider;
    }
}
