<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "vw_purchase_request".
 *
 * @property integer $purchase_request_id
 * @property string $purchase_request_sai_number
 * @property string $purchase_request_number
 * @property string $division_name
 * @property string $section_name
 * @property string $purchase_request_purpose
 * @property string $requested_by
 * @property string $po_number
 */
class VwPurchaseRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_purchase_request';
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
            [['purchase_request_id'], 'integer'],
            [['division_name', 'section_name'], 'required'],
            [['purchase_request_purpose', 'po_number'], 'string'],
            [['purchase_request_sai_number'], 'string', 'max' => 255],
            [['purchase_request_number', 'requested_by'], 'string', 'max' => 100],
            [['division_name', 'section_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_request_id' => 'Purchase Request ID',
            'purchase_request_sai_number' => 'Purchase Request Sai Number',
            'purchase_request_number' => 'Purchase Request Number',
            'division_name' => 'Division Name',
            'section_name' => 'Section Name',
            'purchase_request_purpose' => 'Purchase Request Purpose',
            'requested_by' => 'Requested By',
            'po_number' => 'Po Number',
        ];
    }
}
