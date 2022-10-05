<?php

namespace common\models\system;

use Yii;

/**
 * This is the model class for table "tbl_recipient_contactinfo".
 *
 * @property integer $recipient_contactinfo_id
 * @property integer $recipient_id
 * @property string $sms
 * @property string $email
 */
class Recipientcontactinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recipient_contactinfo';
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
            [['recipient_id', 'sms', 'email'], 'required'],
            [['recipient_id'], 'integer'],
            [['sms', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipient_contactinfo_id' => 'Recipient Contactinfo ID',
            'recipient_id' => 'Recipient ID',
            'sms' => 'Sms',
            'email' => 'Email',
        ];
    }
}
