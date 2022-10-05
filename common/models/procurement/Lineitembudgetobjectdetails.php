<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_line_item_budget_object_details".
 *
 * @property integer $line_item_budget_object_details_id
 * @property integer $line_item_budget_object_id
 * @property integer $object_detail_id
 * @property integer $quantity
 * @property string $name
 * @property string $details
 * @property double $amount
 *
 * @property LineItemBudgetObject $lineItemBudgetObject
 * @property ObjectDetail $objectDetail
 */
class Lineitembudgetobjectdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_line_item_budget_object_details';
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
            [['line_item_budget_object_id', 'object_detail_id', 'quantity', 'name', 'details', 'amount'], 'required'],
            [['line_item_budget_object_id', 'object_detail_id', 'quantity'], 'integer'],
            [['details'], 'string'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 200],
            [['line_item_budget_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lineitembudgetobject::className(), 'targetAttribute' => ['line_item_budget_object_id' => 'line_item_budget_object_id']],
            [['object_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => Objectdetail::className(), 'targetAttribute' => ['object_detail_id' => 'object_detail_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'line_item_budget_object_details_id' => 'Line Item Budget Object Details ID',
            'line_item_budget_object_id' => 'Line Item Budget Object ID',
            'object_detail_id' => 'Object Detail ID',
            'quantity' => 'Quantity',
            'name' => 'Name',
            'details' => 'Details',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineItemBudgetObject()
    {
        return $this->hasOne(Lineitembudgetobject::className(), ['line_item_budget_object_id' => 'line_item_budget_object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectDetail()
    {
        return $this->hasOne(Objectdetail::className(), ['object_detail_id' => 'object_detail_id']);
    }
}
