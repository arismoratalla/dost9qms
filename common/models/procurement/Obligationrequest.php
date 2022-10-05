<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_obligationrequest".
 *
 * @property integer $obligation_request_id
 * @property string $os_no
 * @property string $os_date
 * @property string $particulars
 * @property string $ppa
 * @property string $account_code
 * @property string $amount
 * @property string $payee
 * @property string $office
 * @property string $address
 * @property integer $requested_by
 * @property string $requested_bypos
 * @property integer $funds_available
 * @property string $funds_available_pos
 * @property string $purchase_no
 * @property string $os_type
 * @property string $dv_no
 * @property integer $user_id
 * @property string $resp_center
 */
class Obligationrequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_obligationrequest';
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
            [['os_date'], 'safe'],
            [['particulars'], 'string'],
            [['amount','user_id','requested_by','funds_available'], 'number'],
            [['os_no','resp_center', 'ppa', 'account_code', 'payee', 'office', 'requested_bypos', 'funds_available_pos', 'purchase_no', 'os_type', 'dv_no'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['payee'],'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'obligation_request_id' => 'Obligation Request ID',
            'os_no' => 'OS No',
            'os_date' => 'Os Date',
            'particulars' => 'Particulars',
            'ppa' => 'PPA',
            'account_code' => 'Account Code',
            'amount' => 'Amount',
            'payee' => 'Payee',
            'office' => 'Office',
            'address' => 'Address',
            'requested_by' => 'Requested By',
            'requested_bypos' => 'Requested Bypos',
            'funds_available' => 'Funds Available',
            'funds_available_pos' => 'Funds Available Pos',
            'purchase_no' => 'Purchase No',
            'os_type' => 'Os Type',
            'dv_no' => 'Dv No',
            'user_id' => 'User ID',
            'resp_center' =>'Responsibility Center',
        ];
    }
}
