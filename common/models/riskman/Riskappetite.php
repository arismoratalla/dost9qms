<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_risk_appetite".
 *
 * @property integer $risk_appetite_id
 * @property integer $min_rating
 * @property integer $max_rating
 * @property string $evaluation
 * @property string $todo
 */
class Riskappetite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_risk_appetite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['min_rating', 'max_rating', 'evaluation', 'todo'], 'required'],
            [['min_rating', 'max_rating'], 'integer'],
            [['todo'], 'string'],
            [['evaluation'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'risk_appetite_id' => 'Risk Appetite ID',
            'min_rating' => 'Min Rating',
            'max_rating' => 'Max Rating',
            'evaluation' => 'Evaluation',
            'todo' => 'Todo',
        ];
    }
}
