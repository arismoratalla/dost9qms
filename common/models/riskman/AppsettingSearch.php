<?php

namespace common\models\riskman;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\riskman\Appsetting;

/**
 * AppsettingSearch represents the model behind the search form about `common\models\riskman\Appsetting`.
 */
class AppsettingSearch extends Appsetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'name', 'code', 'setting'], 'required'],
            [['setting'], 'integer'],
            [['module'], 'string', 'max' => 20],
            [['name', 'code'], 'string', 'max' => 25],
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
        $query = Appsetting::find();

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
            'module' => $this->module,
            'name' => $this->name,
            'code' => $this->code,
            'settiing' => $this->settiing,
        ]);

        // $query->andFilterWhere(['like', 'preventive_control_initiatives', $this->preventive_control_initiatives])
        //     ->andFilterWhere(['like', 'corrective_additional_action', $this->corrective_additional_action]);

        return $dataProvider;
    }
}
