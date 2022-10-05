<?php

namespace common\models\system;

use Yii;

/**
 * This is the model class for table "tbl_notification".
 *
 * @property integer $notification_id
 * @property string $hash
 * @property integer $sender
 * @property integer $recipient
 * @property integer $status
 * @property string $title
 * @property string $message
 * @property string $via
 * @property string $created_at
 * @property string $module
 * @property string $action
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_notification';
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert === true) {
            switch ($this->via) {
                case 'sms':
                    $this->createSMS();
                    break;
                case 'email':
                    $this->createEmail();
                    break;
                case 'sms,email':
                    $this->createSMS();
                    $this->createEmail();
                    break;
                default:
                    return '';
            }
        }
        return parent::afterSave($insert, $changedAttributes);
     }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hash', 'sender', 'recipient', 'status', 'title', 'message', 'via', 'created_at', 'module', 'action'], 'required'],
            [['sender', 'recipient', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['hash'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 200],
            [['via', 'module', 'action'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notification_id' => 'Notification ID',
            'hash' => 'Hash',
            'sender' => 'Sender',
            'recipient' => 'Recipient',
            'status' => 'Status',
            'title' => 'Title',
            'message' => 'Message',
            'via' => 'Via',
            'created_at' => 'Created At',
            'module' => 'Module',
            'action' => 'Action',
        ];
    }
    
    public function createSMS()
    {
        $myfile = fopen("sms/qwerty1", "w") or die("Unable to open file!");
        $txt = "To: 639177975944 \r\n \r\n";
        fwrite($myfile, $txt);
        $txt = 'Message FAIMS';
        fwrite($myfile, $txt);
        fclose($myfile);
        copy('sms/qwerty', '/var/spool/sms/modem1');
    }
    
    public function createEmail()
    {
        return '';
    } 
}
