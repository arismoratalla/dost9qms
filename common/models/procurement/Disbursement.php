<?php

namespace common\models\procurement;

use Yii;

/**
 * This is the model class for table "tbl_disbursement".
 *
 * @property integer $dv_id
 * @property string $dv_no
 * @property string $dv_date
 * @property string $particulars
 * @property string $payee
 * @property string $address
 * @property string $dv_amount
 * @property string $dv_total
 * @property integer $certified_a
 * @property integer $certified_b
 * @property integer $approved
 * @property string $os_no
 * @property integer $taxable
 * @property string $dv_type
 * @property string $po_no
 * @property integer $funding_id
 * @property string $fundings
 * @property integer $supporting_docs
 * @property integer $cash_available
 * @property integer $subject_ada
 * @property integer $user_id
 */
class Disbursement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_disbursement';
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
            [['dv_date'], 'safe'],
            [['particulars'], 'string'],
            [['dv_amount', 'dv_total'], 'number'],
            [['dv_amount','particulars'], 'required'],
            [['certified_a', 'certified_b', 'approved', 'taxable', 'funding_id', 'supporting_docs', 'cash_available', 'subject_ada', 'user_id'], 'integer'],
            [['dv_no', 'payee', 'os_no', 'dv_type', 'po_no', 'fundings'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dv_id' => 'Dv ID',
            'dv_no' => 'Dv No',
            'dv_date' => 'Dv Date',
            'particulars' => 'Particulars',
            'payee' => 'Payee',
            'address' => 'Address',
            'dv_amount' => 'Dv Amount',
            'dv_total' => 'Dv Total',
            'certified_a' => 'Certified A',
            'certified_b' => 'Certified B',
            'approved' => 'Approved',
            'os_no' => 'Os No',
            'taxable' => 'Taxable',
            'dv_type' => 'Dv Type',
            'po_no' => 'Po No',
            'funding_id' => 'Funding ID',
            'fundings' => 'Fundings',
            'supporting_docs' => 'Supporting Docs',
            'cash_available' => 'Cash Available',
            'subject_ada' => 'Subject Ada',
            'user_id' => 'User ID',
        ];
    }
}
