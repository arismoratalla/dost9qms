<?php

namespace common\models\apiservice;

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
}
