<?php

namespace common\models\cashier;

use Yii;
use common\models\procurement\Expenditureobject;
use common\models\cashier\Creditor;
use common\models\finance\Osdv;
use common\models\finance\Requestpayroll;
/**
 * This is the model class for table "tbl_lddapada_item".
 *
 * @property integer $lddapada_item_id
 * @property integer $lddapada_id
 * @property integer $creditor_id
 * @property integer $creditor_type_id
 * @property string $name
 * @property string $bank_name
 * @property string $account_number
 * @property double $gross_amount
 * @property integer $alobs_id
 * @property integer $expenditure_object_id
 * @property string $check_number
 * @property integer $active
 *
 * @property Lddapada $lddapada
 * @property ExpenditureObject $expenditureObject
 * @property Creditor $creditor
 */
class Lddapadaitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_lddapada_item';
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
            [['lddapada_id', 'creditor_id', 'creditor_type_id', 'name', 'bank_name', 'account_number', 'gross_amount', 'alobs_id', 'expenditure_object_id'], 'required'],
            [['lddapada_id', 'creditor_id', 'creditor_type_id', 'alobs_id', 'expenditure_object_id', 'active'], 'integer'],
            [['gross_amount'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['bank_name', 'account_number'], 'string', 'max' => 50],
            [['check_number'], 'string', 'max' => 20],
            [['lddapada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lddapada::className(), 'targetAttribute' => ['lddapada_id' => 'lddapada_id']],
            [['expenditure_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expenditureobject::className(), 'targetAttribute' => ['expenditure_object_id' => 'expenditure_object_id']],
            [['creditor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Creditor::className(), 'targetAttribute' => ['creditor_id' => 'creditor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lddapada_item_id' => 'Lddapada Item ID',
            'lddapada_id' => 'Lddapada ID',
            'creditor_id' => 'Creditor ID',
            'creditor_type_id' => 'Creditor Type ID',
            'name' => 'Name',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
            'gross_amount' => 'Gross Amount',
            'alobs_id' => 'Alobs ID',
            'expenditure_object_id' => 'Expenditure Object ID',
            'check_number' => 'Check Number',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLddapada()
    {
        return $this->hasOne(Lddapada::className(), ['lddapada_id' => 'lddapada_id']);
    }
    
     
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsdv()
    {
        return $this->hasOne(Osdv::className(), ['osdv_id' => 'osdv_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestpayroll()
    {
        return $this->hasOne(Requestpayroll::className(), ['request_payroll_id' => 'request_payroll_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenditureObject()
    {
        return $this->hasOne(ExpenditureObject::className(), ['expenditure_object_id' => 'expenditure_object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreditor()
    {
        return $this->hasOne(Creditor::className(), ['creditor_id' => 'creditor_id']);
    }
    
    /*public function getCheckNumber()
    {
        return $this->check_number;
    }*/
}
