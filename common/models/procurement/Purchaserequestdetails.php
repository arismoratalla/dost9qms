<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_purchase_request_details".
 *
 * @property integer $purchase_request_details_id
 * @property integer $purchase_request_id
 * @property integer $purchase_request_details_unit
 * @property integer $unit_id
 * @property string $purchase_request_details_item_description
 * @property string $item_description
 * @property integer $purchase_request_details_quantity
 * @property string $purchase_request_details_price
 * @property string purchase_request_details_status
 */
class PurchaseRequestDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_request_details';
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
            [['purchase_request_id', 'unit_id', 'purchase_request_details_quantity', 'purchase_request_details_status'], 'integer'],
            [['purchase_request_details_price','purchase_request_details_bid_price'], 'number'],
            [['purchase_request_details_item_description', 'item_description', 'purchase_request_details_unit'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_request_details_id' => 'Purchase Request Details ID',
            'purchase_request_id' => 'Purchase Request ID',
            'purchase_request_details_unit' => 'Purchase Request Details Unit',
            'unit_id' => 'Unit ID',
            'purchase_request_details_item_description' => 'Purchase Request Details Item Description',
            'item_description' => 'Item Description',
            'purchase_request_details_quantity' => 'Purchase Request Details Quantity',
            'purchase_request_details_price' => 'Purchase Request Details Price',
            'purchase_request_details_bid_price' => 'Purchase Request Details Bid Price',
            'purchase_request_details_total' => 'Total Cost',
            'purchase_request_details_status' => 'Status',
        ];
    }
    public function getUnittype()
    {
        return $this->hasOne(UnitType::className(), ['unit_type_id' => 'unit_id']);
    }
}
