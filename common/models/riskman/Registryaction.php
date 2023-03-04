<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry_action".
 *
 * @property integer $registry_action_id
 * @property integer $registry_id
 * @property string $preventive_control_initiatives
 * @property string $corrective_additional_action
 * @property string $target_date_of_completion
 * @property integer $qtr
 * @property integer $year
 */
class Registryaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_id', 'preventive_control_initiatives', 'corrective_additional_action', 'target_date_of_completion', 'qtr', 'year'], 'required'],
            [['registry_id', 'qtr', 'year'], 'integer'],
            [['target_date_of_completion'], 'safe'],
            [['preventive_control_initiatives', 'corrective_additional_action'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'registry_action_id' => 'Registry Action ID',
            'registry_id' => 'Registry ID',
            'preventive_control_initiatives' => 'Preventive Control Initiatives',
            'corrective_additional_action' => 'Corrective Additional Action',
            'target_date_of_completion' => 'Target Date Of Completion',
            'qtr' => 'Qtr',
            'year' => 'Year',
        ];
    }
}
