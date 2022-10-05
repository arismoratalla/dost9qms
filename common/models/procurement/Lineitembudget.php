<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_line_item_budget".
 *
 * @property integer $line_item_budget_id
 * @property integer $type_id
 * @property integer $subtype_id
 * @property string $title
 * @property string $period
 * @property string $duration_start
 * @property string $duration_end
 * @property integer $division_id
 * @property integer $section_id
 * @property integer $project_id
 * @property integer $program_id
 *
 * @property LineItemBudgetObject[] $lineItemBudgetObjects
 */
class Lineitembudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_line_item_budget';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('procurementdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'title', 'period'], 'required'],
            [['type_id', 'division_id', 'section_id', 'project_id', 'program_id'], 'integer'],
            [['duration_start', 'duration_end'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['period'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'line_item_budget_id' => 'Line Item Budget ID',
            'type_id' => 'Type',
            'subtype_id' => 'SubType',
            'title' => 'Title',
            'period' => 'Period',
            'duration_start' => 'Duration Start',
            'duration_end' => 'Duration End',
            'division_id' => 'Division',
            'section_id' => 'Section',
            'project_id' => 'Project',
            'program_id' => 'Program',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudgetObjects()
    {
        return $this->hasMany(LineItemBudgetObject::className(), ['line_item_budget_id' => 'line_item_budget_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['section_id' => 'section_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['division_id' => 'division_id']);
    }
}
