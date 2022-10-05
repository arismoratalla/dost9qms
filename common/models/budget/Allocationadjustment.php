<?php

namespace common\models\budget;

use Yii;

/**
 * This is the model class for table "tbl_allocation_adjustment".
 *
 * @property integer $allocation_adjustment_id
 * @property integer $item_id
 * @property integer $item_detail_id
 * @property integer $source_item
 * @property double $amount
 * @property string $create_date
 * @property integer $created_by
 */
class Allocationadjustment extends \yii\db\ActiveRecord
{
    public $destination_id;
    public $new_item;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_allocation_adjustment';
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
            [['item_id', 'item_detail_id', 'source_item', 'created_by'], 'integer'],
            [['source_item', 'amount', 'create_date', 'created_by'], 'required'],
            [['amount'], 'number'],
            [['create_date', 'destination_id', 'new_item'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'allocation_adjustment_id' => 'Allocation Adjustment ID',
            'item_id' => 'Item ID',
            'item_detail_id' => 'Item Detail ID',
            'source_item' => 'Source Item',
            'amount' => 'Amount',
            'create_date' => 'Create Date',
            'created_by' => 'Created By',
        ];
    }
    
    public function getBudgetAllocationItem()
    {
        return $this->hasOne(Budgetallocationitem::className(), ['budget_allocation_item_id' => 'item_id']);
    }
    
    public function getSourceItem()
    {
        return $this->hasOne(Budgetallocationitem::className(), ['budget_allocation_item_id' => 'source_item']);
    }
    
    public function getSourceSection()
    {
        return $this->sourceItem->budgetallocation->section->name;
    }
}
