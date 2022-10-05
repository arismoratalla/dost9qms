<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_bids_details".
 *
 * @property integer $bids_details_id
 * @property integer $bids_id
 * @property string $bids_unit
 * @property string $bids_item_description
 * @property integer $bids_quantity
 * @property string $bids_price
 * @property integer $bids_details_status
 * @property integer $purchase_request_details_id
 * @property integer $bids_remarks
 */
class BidsDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bids_details';
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
            [['bids_id', 'bids_quantity', 'bids_details_status','purchase_request_id'], 'integer'],
            [['bids_price'], 'number'],
            [['bids_unit'], 'string', 'max' => 100],
            [['bids_item_description','bids_remarks'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bids_details_id' => 'Bids Details ID',
            'bids_id' => 'Bids ID',
            'bids_unit' => 'Bids Unit',
            'purchase_request_id' => 'Request ID',
            'purchase_request_details_id' => '',
            'bids_item_description' => 'Bids Item Description',
            'bids_quantity' => 'Bids Quantity',
            'bids_price' => 'Bids Price',
            'bids_details_status' => 'Bids Details Status',
            'bids_remarks' => 'Bids Remarks',
        ];
    }

    public function getBid() {
        return $this->hasOne(Bids::className(), ['bids_id'=>'bids_id']);
    }

    public function getPurchaserequestdetail() {
        return $this->hasOne(Purchaserequestdetails::className(), ['purchase_request_details_id'=>'purchase_request_details_id']);
    }

    public  function  getPurchaserequest() {
        return $this->hasMany(Purchaserequest::className(),['purchase_request_id'=>'purchase_request_id']);
    }

    public function getSupplier() {
        return $this->hasOne(Supplier::className(), ['supplier_id'=>'supplier_id']);
    }

}
