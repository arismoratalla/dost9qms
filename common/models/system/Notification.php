<?php

namespace common\models\system;

use Yii;
use common\models\docman\Functionalunit;

/**
 * This is the model class for table "tbl_notification".
 *
 * @property integer $notification_id
 * @property integer $notification_type
 * @property string $message
 * @property integer $group_id
 * @property integer $user_id
 * @property integer $sender_id
 */
class Notification extends \yii\db\ActiveRecord
{
    const TYPE_MSG = 10;   
    const TYPE_NOTIF = 20; 
    const TYPE_TASK = 30;  

    const SCOPE_APPROVE = 10;  // For REGISTRY DRAFTS
    const SCOPE_REVIEW = 20;  // For QTR Evualation
    const SCOPE_MISC = 30;  // Others

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_type', 'notification_scope', 'message'], 'required'],
            [['notification_type', 'notification_type', 'group_id', 'user_id', 'sender_id'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'notification_id' => 'Notification ID',
            'notification_type' => 'Notification Type',
            'notification_scope' => 'Notification Scope',
            'message' => 'Message',
            'group_id' => 'Group ID',
            'user_id' => 'User ID',
            'sender_id' => 'Sender ID',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert === true) {
            //Yii::$app->Notification->sendEmail('', 2, 'arismoratalla@gmail.com', 'Aftersave', 'Test Email', 'DMS', '', '');
            $recipient = Functionalunit::findOne($this->group_id);
            Yii::$app->Notification->sendEmail(
                '',                                     // $hash
                $this->sender_id,                       // $sender
                $recipient->unithead->email,                      // $recipient
                'Risk and Opportunity Management App',  // $title
                $this->message,                         // $message
                'Document Management System',           // $via
                '',                      // $module
                '');                     // $action
        }
        
        // $recipient = Functionalunit::findOne($this->group_id);
        /*if ($this->isNewRecord) {
            Yii::$app->Notification->sendEmail(
                '',                                     // $hash
                2,                                      // $sender
                'arismoratalla@gmail.com',   // $recipient
                //$recipient->unithead->profile->email,   // $recipient
                'Risk and Opportunity Management App',  // $title
                $this->message,                         // $message
                'Document Management System',           // $via
                $this->module->id,                      // $module
                $this->action->id);                     // $action
        }*/

        return parent::afterSave($insert, $changedAttributes);
    }
}
