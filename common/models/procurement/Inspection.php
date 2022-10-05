<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_purchase_request".
 *
 * @property integer $purchase_request_id
 * @property string $purchase_request_number
 * @property string $purchase_request_sai_number
 * @property integer $department_id
 * @property integer $section_id
 * @property string $purchase_request_date
 * @property string $purchase_request_saidate
 * @property string $purchase_request_purpose
 * @property string $purchase_request_referrence_no
 * @property string $purchase_request_project_name
 * @property string $purchase_request_location_project
 * @property integer $purchase_request_requestedby_id
 * @property integer $purchase_request_approvedby_id
 */
class Inspection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'section_id', 'purchase_request_requestedby_id', 'purchase_request_approvedby_id'], 'integer'],
            [['purchase_request_date', 'purchase_request_saidate'], 'safe'],
            [['purchase_request_number', 'purchase_request_referrence_no', 'purchase_request_project_name', 'purchase_request_location_project'], 'string', 'max' => 100],
            [['purchase_request_sai_number', 'purchase_request_purpose'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'purchase_request_id' => 'Purchase Request ID',
            'purchase_request_number' => 'Purchase Request Number',
            'purchase_request_sai_number' => 'Purchase Request Sai Number',
            'department_id' => 'Department ID',
            'section_id' => 'Section ID',
            'purchase_request_date' => 'Purchase Request Date',
            'purchase_request_saidate' => 'Purchase Request Saidate',
            'purchase_request_purpose' => 'Purchase Request Purpose',
            'purchase_request_referrence_no' => 'Purchase Request Referrence No',
            'purchase_request_project_name' => 'Purchase Request Project Name',
            'purchase_request_location_project' => 'Purchase Request Location Project',
            'purchase_request_requestedby_id' => 'Purchase Request Requestedby ID',
            'purchase_request_approvedby_id' => 'Purchase Request Approvedby ID',
        ];
    }
}
