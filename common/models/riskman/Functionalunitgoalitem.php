<?php

namespace common\models\riskman;

use Yii;
use common\models\docman\Functionalunit;

/**
 * This is the model class for table "tbl_functional_unit_goal_item".
 *
 * @property integer $functional_unit_goal_item_id
 * @property integer $goal_item_id
 * @property integer $unit_id
 * @property integer $count
 * @property integer $target
 */
class Functionalunitgoalitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_functional_unit_goal_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goal_item_id', 'unit_id', 'count', 'target'], 'required'],
            [['goal_item_id', 'unit_id', 'count', 'target'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'functional_unit_goal_item_id' => 'Functional Unit Goal Item ID',
            'goal_item_id' => 'Goal Item ID',
            'unit_id' => 'Unit ID',
            'count' => 'Count',
            'target' => 'Target',
        ];
    }

    public function getFunctionalunit()
    {
        return $this->hasOne(Functionalunit::className(), ['functional_unit_id' => 'unit_id']);
    }
}
