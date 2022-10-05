<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_bids".
 *
 * @property integer $bids_id
 * @property integer $supplier_id
 * @property integer $purchase_request_id
 * @property integer $bids_status
 */
class Bids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bids';
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
            [['supplier_id', 'purchase_request_id', 'bids_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bids_id' => 'Bids ID',
            'supplier_id' => 'Supplier ID',
            'purchase_request_id' => 'Purchase Request ID',
            'bids_status' => 'Bids Status',
        ];
    }

    

    public function getSupplier() {
        return $this->hasOne(Supplier::className(), ['supplier_id'=>'supplier_id']);
    }


}
