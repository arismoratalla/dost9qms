<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_opportunity_appetite".
 *
 * @property integer $opportunity_appetite_id
 * @property integer $min_rating
 * @property integer $max_rating
 * @property string $evaluation
 * @property string $todo
 */
class Opportunityappetite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_opportunity_appetite';
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
            'opportunity_appetite_id' => 'Opportunity Appetite ID',
            'min_rating' => 'Min Rating',
            'max_rating' => 'Max Rating',
            'evaluation' => 'Evaluation',
            'todo' => 'Todo',
        ];
    }
}
