<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Request;

/**
 * RequestSearch represents the model behind the search form about `common\models\finance\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */ 
    public function rules()
    {
        return [
            [['request_id', 'request_number', 'request_type_id', 'obligation_type_id', 'status_id', 'created_by'], 'integer'],
            [['request_date', 'payee_id', 'particulars'], 'safe'],
            [['amount'], 'number'],
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
        $query = Request::find();

        $this->load($params);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                // this $params['pagesize'] is an id of dropdown list that we set in view file
                'pagesize' => (isset($params['pagesize']) ? $params['pagesize'] :  '10'),
            ],
            'sort'=> ['defaultOrder' => ['request_id'=>SORT_DESC]]
        ]);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'request_id' => $this->request_id,
            'obligation_type_id' => $this->obligation_type_id,
            'request_date' => $this->request_date,
            'request_type_id' => $this->request_type_id,
            'payee_id' => $this->payee_id,
            'amount' => $this->amount,
            'status_id' => $this->status_id,
            'division_id' => $this->division_id,
            'created_by' => $this->created_by,
            'cancelled' => 0,
        ]);
        /** UserIDs : ** MAW=2 , RSS=4 , MLK=3 , GFP=62 , NMA=70 , JAP=54 , RJA=55 **/
        
        /** PayeeIDs :  MAW=132 , RSS=129 , MLK=120 , GFP=126 , NMA=108 , JAP=127 , RJA=110 **/
        
        if((Yii::$app->user->identity->user_id == 2)){
            //$query->andFilterWhere(['in', 'payee_id', $this->payee_id])
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                  ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }elseif((Yii::$app->user->identity->user_id == 4)){
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id]);
                //->andFilterWhere(['', 'payee_id', 129]);
        }elseif((Yii::$app->user->identity->user_id == 3)){
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }elseif((Yii::$app->user->identity->user_id == 62)){
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }elseif((Yii::$app->user->identity->user_id == 70)){
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }elseif((Yii::$app->user->identity->user_id == 54)){
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }elseif((Yii::$app->user->identity->user_id == 55)){
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }
        /*if(($this->user_id == 2)){
            $query->andFilterWhere(['in', 'payee_id', $this->payee_id])
                  ->andFilterWhere(['>=', 'status_id', $this->status_id]);
        }elseif(($this->user_id == 4)){
            //$query->andFilterWhere(['<>', 'payee_id', 129])
                //->andFilterWhere(['!=', 'payee_id', 129])
            $query->andFilterWhere(['in', 'division_id', $this->division_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id])
                ->andFilterWhere(['!=', 'payee_id', 129]);
            //->andFilterWhere(['<>', 'payee_id', $this->payee_id]);
        }else{
             $query->andFilterWhere(['like', 'payee_id', $this->payee_id])
                ->andFilterWhere(['>=', 'status_id', $this->status_id])
                ->andFilterWhere(['like', 'particulars', $this->particulars]);    
        }*/
        
        /*if(isset($this->status_id)){
            $query->andFilterWhere(['>', 'status_id', $this->status_id]);
        }*/
        
        $query->andFilterWhere(['like', 'request_number', $this->request_number]);
        
        return $dataProvider;
    }
}
