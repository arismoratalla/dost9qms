<?php

namespace common\models\riskman;

use Yii;

/**
 * This is the model class for table "tbl_registry_assessment_id".
 *
 * @property integer $registry_assessment_id
 * @property integer $registry_id
 * @property integer $likelihood_id
 * @property integer $benefit_consequence_id
 * @property string $cause
 * @property string $effect
 * @property integer $evaluation
 * @property integer $qtr
 * @property integer $year
 */
class Registryassessment extends \yii\db\ActiveRecord
{
    public $preventive_control_initiatives, $corrective_additional_action, $target_date_of_completion;
    public $frequency, $target_date, $monitoring_team;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_registry_assessment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registry_id', 'likelihood_id', 'benefit_consequence_id', 'cause', 'effect', 'remarks' ,'evaluation', 'qtr', 'year'], 'required'],
            [['registry_id', 'likelihood_id', 'benefit_consequence_id', 'evaluation', 'qtr', 'year'], 'integer'],
            [['cause', 'effect'], 'string', 'max' => 100],
            [['remarks'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'registry_assessment_id' => 'Assessment',
            'registry_id' => 'Registry',
            'likelihood_id' => 'Likelihood',
            'benefit_consequence_id' => 'Benefit/Consequence',
            'cause' => 'Cause',
            'effect' => 'Effect',
            'evaluation' => 'Evaluation',
            'qtr' => 'Quarter',
            'year' => 'Year',
        ];
    }

    public function getRegistry()
    {
        return $this->hasOne(Registry::className(), ['registry_id' => 'registry_id']);
    }

    public function getLikelihood()
    {
        return $this->hasOne(Likelihoodscale::className(), ['likelihood_id' => 'likelihood_id']);
    }

    public function getBenefit()
    {
        return $this->hasOne(Benefitscale::className(), ['benefit_id' => 'benefit_consequence_id']);
    }

    public function getConsequence()
    {
        return $this->hasOne(Consequencescale::className(), ['consequence_id' => 'benefit_consequence_id']);
    }

    // public function getAction()
    // {
        // return $this->hasOne(Registryaction::className(), ['registry_id' => 'registry_id', 'qtr' => 'qtr']);
            // ->andOnCondition(['qtr' => 'qtr']);
        //    ->where('year = :year', [':year' => $year]);
    // }
}
