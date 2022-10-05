<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Expenditure;

/**
 * ExpenditureSearch represents the model behind the search form about `common\models\procurement\Expenditure`.
 */
class ExpenditureSearch extends Expenditure
{
    public $selectyear;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expenditure_id', 'expenditure_class_id', 'expenditure_subclass_id', 'expenditure_object_id', 'year'], 'integer'],
            [['name', 'code'], 'safe'],
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
     * Creates data provider instance with search  applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }else{
            $year = date('Y');
        }
        $query = Expenditure::find()->where(['year' => $year]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    //'expenditure_object_id' => SORT_ASC, 
                    'expenditure_class_id' => SORT_ASC, 
                    'expenditure_subclass_id' => SORT_ASC, 
                    'name' => SORT_ASC, 
                    
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'expenditure_id' => $this->expenditure_id,
            'expenditure_class_id' => $this->expenditure_class_id,
            'expenditure_subclass_id' => $this->expenditure_subclass_id,
            'expenditure_object_id' => $this->expenditure_object_id,
            'year' => $this->year,
            'amount' => $this->amount,
            'active' => 1,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['<>', 'year', $this->year])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
