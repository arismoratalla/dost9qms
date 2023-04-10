<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry".
 *
 * @property integer $registry_id
 * @property string $registry_type
 * @property string $code
 * @property integer $unit_id
 * @property integer $area_id
 * @property string $stakeholders
 * @property string $customer_requirement
 * @property string $potential
 * @property string $create_date
 * @property integer $active 
 */
class Registry extends \yii\db\ActiveRecord
{
    public $previous_evaluation, $assessment_id, $evaluation_id;
    public $preventive_control_initiatives, $corrective_additional_action, $target_date_of_completion;
    public $frequency, $target_date, $monitoring_team;

    // access-finance
    const STATUS_CREATED = 10;   // end user
    const STATUS_SUBMITTED = 20; // end user
    const STATUS_ACTIVE = 30; // end user
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_type', 'customer_requirement', 'potential'], 'string'],
            [['source_id', 'unit_id', 'area_id','stakeholders', 'potential'], 'required'],
            [['unit_id', 'area_id','created_by',  'active'], 'integer'],
            [['code','previous_evaluation', 'assessment_id', 'evaluation_id','create_date'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['stakeholders'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'registry_id' => 'Registry ID',
            'registry_type' => 'Registry Type',
            'source_id' => 'Source',
            'code' => 'Code',
            'unit_id' => 'Unit ID',
            'area_id' => 'Area ID',
            'sub_area' => 'Sub Area',
            'stakeholders' => 'Stakeholders',
            'customer_requirement' => 'Customer Requirement',
            'potential' => 'Potential',
            'create_date' => 'Create Date',
            'customer_requirement' => 'Customer Requirement',
            'potential' => 'Potential',
            'create_date' => 'Create Date',
            'active' => 'Active', 
            'created_by' => 'Created By', 
        ];
    }

    // public function getAssessment($year = NULL)
    public function getAssessment()
    {
        return $this->hasMany(Registryassessment::className(), ['registry_id' => 'registry_id']);
        //return $this->hasMany(Registryassessment::className(), ['registry_id' => 'registry_id'])
        //    ->where('year = :year', [':year' => $year]);
    }

    public function getAction()
    {
        return $this->hasMany(Registryaction::className(), ['registry_id' => 'registry_id']);
        //return $this->hasMany(Registryassessment::className(), ['registry_id' => 'registry_id'])
        //    ->where('year = :year', [':year' => $year]);
    }

    public function getMonitoring()
    {
        return $this->hasOne(Registrymonitoring::className(), ['registry_id' => 'registry_id']);
    }

    public function getSource()
    {
        return $this->hasOne(Registrysource::className(), ['source_id' => 'source_id']);
    }

    public function getArea()
    {
        return $this->hasOne(Registryarea::className(), ['area_id' => 'area_id']);
    }
}
