<?php

namespace common\models\budget;

use Yii;
use common\models\budget\Budgetallocationitem;
use common\models\procurement\Fundsource;
/**
 * This is the model class for table "tbl_budget_allocation_item_details".
 *
 * @property integer $budget_allocation_item_detail_id
 * @property integer $budget_allocation_item_id
 * @property integer $fund_source_id
 * @property integer $program_id
 * @property integer $section_id
 * @property string $name
 * @property double $amount
 * @property integer $active
 */
class Budgetallocationitemdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_budget_allocation_item_details';
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
            [['budget_allocation_item_id', 'fund_source_id', 'program_id', 'section_id', 'name', 'amount'], 'required'],
            [['budget_allocation_item_id', 'fund_source_id', 'program_id', 'section_id', 'active'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'budget_allocation_item_detail_id' => 'Budget Allocation Item Detail ID',
            'budget_allocation_item_id' => 'Budget Allocation Item ID',
            'fund_source_id' => 'Fund Source ID',
            'program_id' => 'Program ID',
            'section_id' => 'Section ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'active' => 'Active',
        ];
    }
    
    public function getBudgetallocationitem()
    {
        return $this->hasOne(Budgetallocationitem::className(), ['budget_allocation_item_id' => 'budget_allocation_item_id']);
    }
    
    public function getFundsource()
    {
        return $this->hasOne(Fundsource::className(), ['fund_source_id' => 'fund_source_id']);
    }
}
