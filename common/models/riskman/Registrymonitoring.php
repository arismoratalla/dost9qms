<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry_monitoring".
 *
 * @property integer $registry_monitoring_id
 * @property integer $registry_id
 * @property string $frequency
 * @property string $target_date
 * @property string $monitoring_team
 */
class Registrymonitoring extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry_monitoring';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency', 'target_date', 'monitoring_team'], 'required'],
            [['registry_id'], 'integer'],
            [['target_date'], 'safe'],
            [['frequency', 'monitoring_team'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'registry_monitoring_id' => 'Registry Monitoring ID',
            'registry_id' => 'Registry ID',
            'frequency' => 'Frequency',
            'target_date' => 'Target Date',
            'monitoring_team' => 'Monitoring Team',
        ];
    }
}
