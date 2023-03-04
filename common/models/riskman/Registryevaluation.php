<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry_evaluation".
 *
 * @property integer $registry_evaluation_id
 * @property integer $registry_id
 * @property integer $evaluation
 * @property integer $year
 */
class Registryevaluation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry_evaluation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_id', 'evaluation', 'year'], 'required'],
            [['registry_id', 'evaluation', 'year'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'registry_evaluation_id' => 'Registry Evaluation ID',
            'registry_id' => 'Registry ID',
            'evaluation' => 'Evaluation',
            'year' => 'Year',
        ];
    }
}
