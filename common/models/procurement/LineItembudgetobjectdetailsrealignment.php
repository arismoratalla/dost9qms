<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_line_item_budget_object_details_realignment".
 *
 * @property integer $line_item_budget_object_details_realignment_id
 * @property integer line_item_budget_object_realignment_id
 * @property integer $line_item_budget_object_id
 * @property integer $object_detail_id
 * @property integer $quantity
 * @property string $name
 * @property string $details
 * @property double $amount
 * @property string $realignment_date
 */
class Lineitembudgetobjectdetailsrealignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_line_item_budget_object_details_realignment';
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
            [['line_item_budget_object_realignment_id', 'line_item_budget_object_id', 'object_detail_id', 'quantity', 'name', 'details', 'amount', 'realignment_date'], 'required'],
            [['line_item_budget_object_realignment_id', 'line_item_budget_object_id', 'object_detail_id', 'quantity'], 'integer'],
            [['details'], 'string'],
            [['amount'], 'number'],
            [['realignment_date'], 'safe'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'line_item_budget_object_details_realignment_id' => 'Line Item Budget Object Details Realignment ID',
            'line_item_budget_object_realignment_id' => 'Line Item Budget Object Details ID',
            'line_item_budget_object_id' => 'Line Item Budget Object ID',
            'object_detail_id' => 'Object Detail ID',
            'quantity' => 'Quantity',
            'name' => 'Name',
            'details' => 'Details',
            'amount' => 'Amount',
            'realignment_date' => 'Realignment Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudgetObject()
    {
        return $this->hasOne(LineItemBudgetObjectRealignment::className(), ['line_item_budget_object_id' => 'line_item_budget_object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectDetail()
    {
        return $this->hasOne(ObjectDetail::className(), ['object_detail_id' => 'object_detail_id']);
    }
}
