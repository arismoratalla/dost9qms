<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_goal_item".
 *
 * @property integer $goal_item_id
 * @property integer $goal_id
 * @property string $registry_type
 * @property string $scope
 * @property integer $index_id
 * @property integer $goal_target
 * @property string $date_achieved
 */
class Goalitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_goal_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goal_id', 'goal_target', 'date_achieved'], 'required'],
            [['goal_id', 'index_id', 'goal_target'], 'integer'],
            [['date_achieved'], 'safe'],
            [['registry_type'], 'string', 'max' => 25],
            [['scope'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goal_item_id' => 'Goal Item ID',
            'goal_id' => 'Goal ID',
            'registry_type' => 'Registry Type',
            'scope' => 'Scope',
            'index_id' => 'Index ID',
            'goal_target' => 'Goal Target',
            'date_achieved' => 'Date Achieved',
        ];
    }
}
