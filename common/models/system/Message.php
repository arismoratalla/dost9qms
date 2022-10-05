<?php

namespace common\models\system;

use Yii;

/**
 * This is the model class for table "tbl_message".
 *
 * @property integer $id
 * @property string $hash
 * @property integer $from
 * @property integer $to
 * @property integer $status
 * @property string $title
 * @property string $message
 * @property string $created_at
 * @property string $context
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hash', 'title', 'created_at'], 'required'],
            [['from', 'to', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['hash'], 'string', 'max' => 32],
            [['title', 'context'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'from' => 'From',
            'to' => 'To',
            'status' => 'Status',
            'title' => 'Title',
            'message' => 'Message',
            'created_at' => 'Created At',
            'context' => 'Context',
        ];
    }
    public function getSender(){
        return $this->hasOne(User::className(), ['user_id'=>'from']);
    }
     public function getRecipient()
    {
        return $this->hasOne(User::className(), ['user_id' => 'to']);
    }
}
