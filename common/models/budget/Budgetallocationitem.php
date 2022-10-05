<?php

namespace common\models\budget;

use common\models\budget\Allocationajustment;
use common\models\budget\Budgetallocation;
use common\models\budget\Budgetallocationitemdetails;
use common\models\procurement\Expenditure;
use common\models\procurement\Expenditureobject;
use common\models\procurement\Expenditureclass;
use common\models\procurement\Expendituresubclass;
use Yii;

/**
 * This is the model class for table "tbl_budget_allocation_item".
 *
 * @property integer $budget_allocation_item_id
 * @property integer $budget_allocation_id
 * @property string $name
 * @property string $code
 * @property integer $category_id
 * @property double $amount
 */
class Budgetallocationitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $year;
    public static function tableName()
    {
        return 'tbl_budget_allocation_item';
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
            [['budget_allocation_id', 'name', 'code', 'category_id', 'amount'], 'required'],
            [['budget_allocation_id', 'category_id'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 30],
            [['code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'budget_allocation_item_id' => 'Budget Allocation Item ID',
            'budget_allocation_id' => 'Budget Allocation ID',
            'name' => 'Name',
            'code' => 'Code',
            'category_id' => 'Category ID',
            'amount' => 'Amount',
        ];
    }
    
    public function afterFind()
    {
        $this->amount = $this->amount + $this->totalAdjustments;
        return parent::afterFind();
    }
    
    public function getBudgetallocation()
    {
        return $this->hasOne(Budgetallocation::className(), ['budget_allocation_id' => 'budget_allocation_id']);
    }
    
    public function getExpenditureobject()
    {
        return $this->hasOne(Expenditureobject::className(), ['expenditure_object_id' => 'category_id']);
    }
    
    public function getExpenditureClass()
    {
        return $this->hasOne(Expenditureclass::className(), ['expenditure_class_id' => 'expenditure_class_id']);
    }
    
    public function getExpenditureSubclass()
    {
        return $this->hasOne(Expendituresubclass::className(), ['expenditure_sub_class_id' => 'expenditure_subclass_id']);
    }
    
    public function getExpenditure()
    {
        return $this->hasOne(Expenditure::className(), ['expenditure_object_id' => 'category_id'])->andWhere(['year'=>$this->year]);
    }
    
    public function getItemdetails()
    {
        return $this->hasMany(Budgetallocationitemdetails::className(), ['budget_allocation_item_id' => 'budget_allocation_item_id'])->andWhere(['active'=>1]);
    }
    
    public function getTotal()
    {
        $sum = $this->hasMany(Budgetallocationitemdetails::className(), ['budget_allocation_item_id' => 'budget_allocation_item_id'])->sum('amount');
        return $sum;
    }
    
    public function getAdjustments()
    {
        return $this->hasMany(Allocationadjustment::className(), ['item_id' => 'budget_allocation_item_id']);
    }
    
    public function getTotalAdjustments()
    {
        return $this->hasMany(Allocationadjustment::className(), ['item_id' => 'budget_allocation_item_id'])->sum('amount');
    }
    public function getExpenditures()
    {
        return $this->hasOne(Expenditure::className(), ['expenditure_object_id' => 'category_id']);
    }
}
