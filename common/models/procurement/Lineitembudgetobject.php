<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_line_item_budget_object".
 *
 * @property integer $line_item_budget_object_id
 * @property integer $line_item_budget_id
 * @property integer $expenditure_object_id
 * @property double $amount
 *
 * @property LineItemBudget $lineItemBudget
 * @property ExpenditureObject $expenditureObject
 * @property LineItemBudgetObjectDetails[] $lineItemBudgetObjectDetails
 */
class Lineitembudgetobject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_line_item_budget_object';
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
            [['line_item_budget_id', 'expenditure_object_id', 'amount'], 'required'],
            [['line_item_budget_id', 'expenditure_object_id'], 'integer'],
            [['amount'], 'number'],
            [['line_item_budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lineitembudget::className(), 'targetAttribute' => ['line_item_budget_id' => 'line_item_budget_id']],
            [['expenditure_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expenditureobject::className(), 'targetAttribute' => ['expenditure_object_id' => 'expenditure_object_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'line_item_budget_object_id' => 'Line Item Budget Object ID',
            'line_item_budget_id' => 'Line Item Budget ID',
            'expenditure_object_id' => 'Expenditure Object ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudget()
    {
        return $this->hasOne(Lineitembudget::className(), ['line_item_budget_id' => 'line_item_budget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureObject()
    {
        return $this->hasOne(Expenditureobject::className(), ['expenditure_object_id' => 'expenditure_object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudgetObjectDetails()
    {
        return $this->hasMany(Lineitembudgetobjectdetails::className(), ['line_item_budget_object_id' => 'line_item_budget_object_id']);
    }
    
    public function getDetails()
    {
        return $this->hasMany(Lineitembudgetobjectdetails::className(), ['line_item_budget_object_id' => 'line_item_budget_object_id'])->sum('amount');
    }
}
