<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_goal".
 *
 * @property integer $goal_id
 * @property string $name
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_goal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goal_id' => 'Goal ID',
            'name' => 'Name',
        ];
    }

    public function getGoalitems()
    {
        return $this->hasMany(Goalitem::className(), ['goal_id' => 'goal_id']);
    }
}
