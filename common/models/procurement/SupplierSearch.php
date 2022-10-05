<?php

namespace common\models\procurement;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\procurement\Supplier;

/**
 * SupplierSearch represents the model behind the search form about `common\models\procurement\Supplier`.
 */
class SupplierSearch extends Supplier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id'], 'integer'],
            [['supplier_name', 'supplier_address', 'supplier_contact'], 'safe'],
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
        $query = Supplier::find();

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
            'supplier_id' => $this->supplier_id,
        ]);

        $query->andFilterWhere(['like', 'supplier_name', $this->supplier_name])
            ->andFilterWhere(['like', 'supplier_address', $this->supplier_address])
            ->andFilterWhere(['like', 'supplier_contact', $this->supplier_contact]);

        return $dataProvider;
    }
}
