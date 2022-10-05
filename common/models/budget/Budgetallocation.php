<?php

namespace common\models\budget;

use Yii;
use common\models\budget\Budgetallocationitem;
use common\models\procurement\Section;
use common\models\procurement\Project;

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * This is the model class for table "tbl_budget_allocation".
 *
 * @property integer $budget_allocation_id
 * @property integer $section_id
 * @property integer $year
 * @property double $amount
 */
class Budgetallocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fais-procurement.tbl_budget_allocation';
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
            [['section_id', 'year', 'amount'], 'required'],
            [['section_id', 'year'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'budget_allocation_id' => 'Budget Allocation ID',
            'section_id' => 'Section ID',
            'year' => 'Year',
            'amount' => 'Amount',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['section_id' => 'section_id']);
    }
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }
    
    public function getItems()
    {
        return $this->hasMany(Budgetallocationitem::className(), ['budget_allocation_id' => 'budget_allocation_id'])->andWhere(['active'=>1]);
    }
    
    public function getTotal()
    {
        $sum = $this->hasMany(Budgetallocationitem::className(), ['budget_allocation_id' => 'budget_allocation_id'])->sum('amount');
        
        $sum2 = 0.00;
        /*foreach($this->items() as $item)
        {
            $sum2 += $item->total; 
        }*/
        
        return $sum + $sum2;
        
    }
    /*public function getTotal()
    {
        $items = self::getItems();
        $sum = 0;
        foreach($items as $item)
            $sum += $item->amount;
        
        //return $items;
        //$budget = Budgetallocation::find()
            //->where(['section_id' => $this->section_id])->one();
        
        //if($budget)
        //{
            $fmt = Yii::$app->formatter;
            //return $budget ? Html::a($fmt->asDecimal(250000), ['budgetallocation/view?id='.$this->budget_allocation_id])  : '-';
            //return Html::a($fmt->asDecimal(250000), ['budgetallocation/view?id='.$this->budget_allocation_id]);
        //}
        
        return $sum;
    }*/
}
