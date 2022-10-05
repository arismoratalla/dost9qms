<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_purchase_order".
 * @property integer $purchase_order_id
 * @property string $purchase_order_number
 * @property integer $supplier_id
 * @property integer $purchase_order_status
 * @property date $purchase_order_date
 * @property string $place_of_delivery
 * @property string $delivery_term
 * @property string $payment_term
 */
class Purchaseorder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_order';
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
            [['supplier_id', 'purchase_order_status'], 'integer'],
            [['purchase_order_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_order_id' => 'purchase_order_id',
            'purchase_order_number' => 'Purchase Order Number',
            'supplier_id' => 'Supplier ID',
            'purchase_order_status' => 'Purchase Order Status',
            'purchase_order_date' => 'Purchase Order Date',
            'place_of_delivery' => 'Place of Delivery',
            'date_of_delivery' => 'Date of Delivery',
            'delivery_term'=> 'Delivery Term',
            'payment_term'=> 'Payment Term',
            'mode_of_procurement'=> 'Mode of Procurement',
        ];
    }
    public function getPurchaseorderdetails()
    {
        return $this->hasMany(Purchaseorderdetails::className(), ['purchase_order_id' => 'purchase_order_id']);
    }
}
