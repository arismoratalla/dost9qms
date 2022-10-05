<?php

namespace common\models\procurement;

use common\models\budget\Budgetallocationitem;
use Yii;

/**
 * This is the model class for table "tbl_expenditure".
 *
 * @property integer $expenditure_id
 * @property integer $expenditure_class_id
 * @property integer $expenditure_subclass_id
 * @property integer $expenditure_object_id
 * @property integer $year
 * @property string $name
 * @property string $code
 * @property double $amount
 */
class Expenditure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_expenditure';
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
            [['expenditure_class_id', 'expenditure_subclass_id', 'expenditure_object_id', 'year', 'name', 'code', 'amount', 'active'], 'required'],
            [['expenditure_class_id', 'expenditure_subclass_id', 'expenditure_object_id', 'year', 'active'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expenditure_id' => 'Expenditure ID',
            'expenditure_class_id' => 'Expenditure Class ID',
            'expenditure_subclass_id' => 'Expenditure Subclass ID',
            'expenditure_object_id' => 'Expenditure Object ID',
            'year' => 'Year',
            'name' => 'Name',
            'code' => 'Code',
            'amount' => 'Amount',
            'active' => 'Active',
        ];
    }
    
    public function getExpenditureClass()
    {
        return $this->hasOne(Expenditureclass::className(), ['expenditure_class_id' => 'expenditure_class_id']);
    }
    
    public function getExpenditureSubclass()
    {
        return $this->hasOne(Expendituresubclass::className(), ['expenditure_sub_class_id' => 'expenditure_subclass_id']);
    }
    
    public function getBudgetAllocationTotal()
    {
        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }else{
            $year = date('Y');
        }
        /*
        $budgetallocation = new Budgetallocationitem();
        $budgetallocation->year = $year;
        $sum = $this->hasMany($budgetallocation::className(), ['category_id' => 'expenditure_object_id'])->joinWith('expenditures')->andWhere(['year'=>$year])->sum('tbl_budget_allocation_item.amount');
        return $sum;*/
       $sum = Budgetallocationitem::find()->joinWith('budgetallocation')
                ->where(['tbl_budget_allocation.year'=>$year,
                         'tbl_budget_allocation_item.category_id'=>$this->expenditure_object_id
                         ])
                ->sum('tbl_budget_allocation_item.amount');
       return $sum;
    }
    
    public function getBudgetAllocationPercent()
    {
        if($this->getBudgetAllocationTotal() != 0)
            //return ($this->getBudgetAllocationTotal() / $this->amount);
            return 0;
        else
            return 0;
    }
}
