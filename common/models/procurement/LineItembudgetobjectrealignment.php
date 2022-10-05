<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_line_item_budget_object_realignment".
 *
 * @property integer $line_item_budget_object_realignment_id
 * @property integer $line_item_budget_object_id
 * @property integer $line_item_budget_id
 * @property integer $expenditure_object_id
 * @property number $amount
 * @property integer $active
 * @property string $realignment_date
 */
class Lineitembudgetobjectrealignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_line_item_budget_object_realignment';
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
            [['line_item_budget_object_id', 'line_item_budget_id', 'expenditure_object_id', 'amount', 'realignment_date'], 'required'],
            [['line_item_budget_object_id', 'line_item_budget_id', 'expenditure_object_id', 'active'], 'integer'],
            [['amount'], 'number'],
            [['realignment_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'line_item_budget_object_realignment_id' => 'Line Item Budget Object Realignment ID',
            'line_item_budget_object_id' => 'Line Item Budget Object ID',
            'line_item_budget_id' => 'Line Item Budget ID',
            'expenditure_object_id' => 'Expenditure Object ID',
            'amount' => 'Amount',
            'active' => 'Active',
            'realignment_date' => 'Realignment Date',
        ];
    }

    public function getProfileCompany(){
        return $this->amount = $this->userProfiles->company;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudget()
    {
        return $this->hasOne(LineItemBudget::className(), ['line_item_budget_id' => 'line_item_budget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureObject()
    {
        return $this->hasOne(ExpenditureObject::className(), ['expenditure_object_id' => 'expenditure_object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudgetObjectDetails()
    {
        return $this->hasMany(LineItemBudgetObjectDetailsRealignment::className(), ['line_item_budget_object_id' => 'line_item_budget_object_id']);
    }

    public function getDetails()
    {
        return $this->hasMany(LineItemBudgetObjectDetailsRealignment::className(), ['line_item_budget_object_id' => 'line_item_budget_object_id'])->sum('amount');
    }

}
