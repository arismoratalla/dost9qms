<?php

namespace common\models\system;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\system\Package;

/**
 * PackageSearch represents the model behind the search form about `common\models\Package`.
 */
class PackageSearch extends Package
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PackageID', 'created_at', 'updated_at'], 'integer'],
            [['PackageName', 'icon'], 'safe'],
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
        $query = Package::find();

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
            'PackageID' => $this->PackageID,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'PackageName', $this->PackageName])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
