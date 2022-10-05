<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_purchase_order_details".
 *
 * @property integer $purchase_order_details_id
 * @property integer $purchase_order_id
 * @property integer $bids_details_id
 * @property integer $purchase_request_details_status
 * @property integer $delivered
 */
class Purchaseorderdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $unit_of_measurement;
    public $quantity;
    public $price;
    public static function tableName()
    {
        return 'tbl_purchase_order_details';
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
            [['purchase_order_id', 'bids_details_id', 'purchase_request_details_status','delivered'], 'integer'],
            [['unit_of_measurement','quantity','price'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_order_details_id' => 'Purchase Order Details ID',
            'purchase_order_id' => 'Purchase Order ID',
            'bids_details_id' => 'Bids Details ID',
            'purchase_request_details_status' => 'Purchase Request Details Status',
            'delivered' => 'Delivered',
            'unit_of_measurement' => 'Unit',
            'quantity' => 'Quantity',
            'price' => 'Price'
        ];
    }
    public function getPurchaseorder()
    {
        return $this->hasOne(Purchaseorder::className(), ['purchase_order_id' => 'purchase_order_id']);
    }
    public function getBidsdetails(){
        return $this->hasOne(Bidsdetails::className(),['bids_details_id' => 'bids_details_id']);
    }
    public function getPurchaseordernumber(){
        return $this->purchaseorder->purchase_order_number;
    }
    public function getItemdescription(){
        return $this->bidsdetails->bids_item_description;
    }
    public function getSuppliername(){
        return $this->bidsdetails->bid->supplier->supplier_name;
    }
    public function getSupplier_id(){
        return $this->bidsdetails->bid->supplier->supplier_id;
    }
    public function getQuantity(){
        return $this->bidsdetails->bid->supplier->supplier_id;
    }
}
