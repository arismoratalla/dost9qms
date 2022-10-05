<?php

namespace common\models\cashier;

use Yii;
use common\models\system\Profile;

/**
 * This is the model class for table "tbl_creditor_tmp".
 *
 * @property integer $creditor_id
 * @property integer $creditor_type_id
 * @property string $name
 * @property string $address
 * @property string $bank_name
 * @property string $account_number
 * @property string $tin_number
 * @property integer $requested_by
 * @property string $date_request
 * @property integer $active
 */
class Creditortmp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_creditor_tmp';
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
            [['name', 'address', 'requested_by', 'date_request'], 'required'],
            [['creditor_type_id', 'requested_by', 'active'], 'integer'],
            [['date_request'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 100],
            [['bank_name', 'account_number', 'tin_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'creditor_id' => 'Creditor ID',
            'creditor_type_id' => 'Creditor Type ID',
            'name' => 'Name',
            'address' => 'Address',
            'bank_name' => 'Bank Name',
            'account_number' => 'Account Number',
            'tin_number' => 'Tin Number',
            'requested_by' => 'Requested By',
            'date_request' => 'Date Request',
            'active' => 'Active',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Creditortype::className(), ['creditor_type_id' => 'creditor_type_id']);
    }
    
    public function getProfile()  
    {  
      return $this->hasOne(Profile::className(), ['user_id' => 'requested_by']);  
    }
}
