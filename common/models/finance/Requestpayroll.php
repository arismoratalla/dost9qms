<?php
namespace common\models\finance;

use common\models\cashier\Creditor;



use Yii;

/**
 * This is the model class for table "tbl_request_payroll".
 *
 * @property integer $request_payroll_id
 * @property integer $osdv_id
 * @property string $name
 * @property double $amount
 * @property integer $active
 */
class Requestpayroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request_payroll';
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
            [['osdv_id', 'amount', 'active'], 'required'],
            [['osdv_id', 'dv_id', 'active'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_payroll_id' => 'Request Payroll ID',
            'osdv_id' => 'Request ID',
            'dv_id' => 'DV Number',
            'name' => 'Name',
            'amount' => 'Amount',
            'active' => 'Active',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditor()
    {
        return $this->hasOne(Creditor::className(), ['creditor_id' => 'creditor_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDv()
    {
        return $this->hasOne(Dv::className(), ['dv_id' => 'dv_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsdv()
    {
        return $this->hasOne(Osdv::className(), ['osdv_id' => 'osdv_id']);
    }
}
