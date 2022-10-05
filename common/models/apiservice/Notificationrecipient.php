<?php

namespace common\models\apiservice;

use Yii;
use common\models\system\Recipientcontactinfo;
/**
 * This is the model class for table "tbl_notification_recipient".
 *
 * @property integer $tbl_notification_recipient_id
 * @property integer $status_id
 * @property string $primary_recipient
 * @property string $secondary_recipient
 * @property integer $active
 */
class Notificationrecipient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_notification_recipient';
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
            [['status_id', 'primary_recipient', 'secondary_recipient', 'active'], 'required'],
            [['status_id', 'active'], 'integer'],
            [['primary_recipient', 'secondary_recipient'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tbl_notification_recipient_id' => 'Tbl Notification Recipient ID',
            'status_id' => 'Status ID',
            'primary_recipient' => 'Primary Recipient',
            'secondary_recipient' => 'Secondary Recipient',
            'active' => 'Active',
        ];
    }
    
    public function getPrimary()  
    {  
      return $this->hasOne(Recipientcontactinfo::className(), ['recipient_id' => 'primary_recipient']);  
    } 
    
    public function getSecondary()  
    {  
      return $this->hasOne(Recipientcontactinfo::className(), ['recipient_id' => 'secondary_recipient']);  
    } 
}
